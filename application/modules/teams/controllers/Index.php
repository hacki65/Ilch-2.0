<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Teams\Controllers;

use Modules\Teams\Mappers\Teams as TeamsMapper;
use Modules\Teams\Mappers\Joins as JoinsMapper;
use Modules\Teams\Models\Joins as JoinsModel;
use Modules\User\Mappers\User as UserMapper;
use Modules\User\Mappers\Group as GroupMapper;
use Ilch\Validation;

class Index extends \Ilch\Controller\Frontend
{
    public function indexAction()
    {
        $teamsMapper = new TeamsMapper();
        $userMapper = new UserMapper();
        $groupMapper = new GroupMapper();

        $this->getLayout()->header()
            ->css('static/css/teams.css');
        $this->getLayout()->getTitle()
            ->add($this->getTranslator()->trans('menuTeams'));
        $this->getLayout()->getHmenu()
            ->add($this->getTranslator()->trans('menuTeams'), ['action' => 'index']);

        $this->getView()->set('userMapper', $userMapper)
            ->set('groupMapper', $groupMapper)
            ->set('teams', $teamsMapper->getTeams());
    }

    public function teamAction()
    {
        $teamsMapper = new TeamsMapper();
        $userMapper = new UserMapper();
        $groupMapper = new GroupMapper();

        $this->getLayout()->header()
            ->css('static/css/teams.css');
        $this->getLayout()->getTitle()
            ->add($this->getTranslator()->trans('menuTeams'));
        $this->getLayout()->getHmenu()
            ->add($this->getTranslator()->trans('menuTeams'), ['action' => 'index'])
            ->add($this->getTranslator()->trans('menuTeam'), ['action' => 'team', 'id' => $this->getRequest()->getParam('id')]);

        $this->getView()->set('userMapper', $userMapper)
            ->set('groupMapper', $groupMapper)
            ->set('team', $teamsMapper->getTeamById($this->getRequest()->getParam('id')));
    }

    public function joinAction()
    {
        $teamsMapper = new TeamsMapper();
        $joinsMapper = new JoinsMapper();
        $userMapper = new UserMapper();
        $groupMapper = new GroupMapper();
        $captchaNeeded = captchaNeeded();

        $this->getLayout()->getTitle()
            ->add($this->getTranslator()->trans('menuTeams'))
            ->add($this->getTranslator()->trans('menuJoin'));
        $this->getLayout()->getHmenu()
            ->add($this->getTranslator()->trans('menuTeams'), ['action' => 'index'])
            ->add($this->getTranslator()->trans('menuJoin'), ['action' => 'join']);

        if ($this->getRequest()->isPost()) {
            $validationRules = [
                'name' => 'required|unique:teams_joins,name,0,undecided',
                'email' => 'required|email|unique:teams_joins,email,0,undecided',
                'teamId' => 'numeric|integer|min:1',
                'gender' => 'numeric|integer|min:1|max:2',
                'birthday' => 'required',
                'text' => 'required'
            ];

            if ($captchaNeeded) {
                $validationRules['captcha'] = 'captcha';
            }

            if ($this->getUser()) {
                $validationRules['name'] = 'required|unique:teams_joins,name,0,undecided';
                $validationRules['email'] = 'required|email|unique:teams_joins,email,0,undecided';
            } else {
                $validationRules['name'] = 'required|unique:users,name|unique:teams_joins,name,0,undecided';
                $validationRules['email'] = 'required|email|unique:users,email|unique:teams_joins,email,0,undecided';
            }

            $validation = Validation::create($this->getRequest()->getPost(), $validationRules);

            if ($validation->isValid()) {
                $model = new JoinsModel();
                $currentDate = new \Ilch\Date();

                if ($this->getUser()) {
                    $model->setUserId($this->getUser()->getId())
                        ->setGender($this->getUser()->getGender());
                } else {
                    $model->setGender($this->getRequest()->getPost('gender'));
                }
                $model->setName($this->getRequest()->getPost('name'))
                    ->setEmail($this->getRequest()->getPost('email'))
                    ->setPlace($this->getRequest()->getPost('place'))
                    ->setBirthday(new \Ilch\Date($this->getRequest()->getPost('birthday')))
                    ->setSkill($this->getRequest()->getPost('skill'))
                    ->setTeamId($this->getRequest()->getPost('teamId'))
                    ->setLocale($this->getTranslator()->getLocale())
                    ->setDateCreated($currentDate->toDb())
                    ->setText($this->getRequest()->getPost('text'))
                    ->setUndecided(1);
                $joinsMapper->save($model);

                $this->redirect()
                    ->withMessage('saveSuccess')
                    ->to(['action' => 'index']);
            }
            $this->addMessage($validation->getErrorBag()->getErrorMessages(), 'danger', true);
            $this->redirect()
                ->withInput()
                ->withErrors($validation->getErrorBag());

            if ($this->getRequest()->getParam('id')) {
                $this->redirect()
                    ->to(['action' => 'join', 'id' => $this->getRequest()->getParam('id')]);
            } else {
                $this->redirect()
                    ->to(['action' => 'join']);
            }
        }

        $this->getView()->set('teamsMapper', $teamsMapper)
            ->set('userMapper', $userMapper)
            ->set('groupMapper', $groupMapper)
            ->set('teams', $teamsMapper->getTeams())
            ->set('captchaNeeded', $captchaNeeded);
    }
}
