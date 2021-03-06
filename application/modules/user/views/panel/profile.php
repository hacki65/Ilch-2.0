<?php
$profil = $this->get('profil');
$profileFields = $this->get('profileFields');
$profileFieldsContent = $this->get('profileFieldsContent');
$profileFieldsTranslation = $this->get('profileFieldsTranslation');
$birthday = new \Ilch\Date($profil->getBirthday());
?>

<link href="<?=$this->getModuleUrl('static/css/user.css') ?>" rel="stylesheet">
<link href="<?=$this->getStaticUrl('js/datetimepicker/css/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">

<div class="row">
    <div class="col-lg-12 profile">
        <?php include APPLICATION_PATH.'/modules/user/views/panel/navi.php'; ?>

        <div class="profile-content active">
            <h1><?=$this->getTrans('profileSettings') ?></h1>
            <form class="form-horizontal" method="POST">
                <?=$this->getTokenField() ?>
                <div class="form-group <?=$this->validation()->hasError('email') ? 'has-error' : '' ?>">
                    <label class="col-lg-2 control-label">
                        <?=$this->getTrans('profileEmail'); ?>*
                    </label>
                    <div class="col-lg-8">
                        <input type="text"
                               class="form-control"
                               name="email"
                               placeholder="<?=$this->escape($profil->getEmail()) ?>"
                               value="<?=($this->originalInput('email') != '') ? $this->escape($this->originalInput('email')) : $this->escape($profil->getEmail()) ?>"
                               required />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <?=$this->getTrans('profileFirstName'); ?>
                    </label>
                    <div class="col-lg-8">
                        <input type="text"
                               class="form-control"
                               name="first-name"
                               placeholder="<?=$this->escape($profil->getFirstName()) ?>"
                               value="<?=($this->originalInput('firstname') != '') ? $this->escape($this->originalInput('firstname')) : $this->escape($profil->getFirstName()) ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <?=$this->getTrans('profileLastName'); ?>
                    </label>
                    <div class="col-lg-8">
                        <input type="text"
                               class="form-control"
                               name="last-name"
                               placeholder="<?=$this->escape($profil->getLastName()) ?>"
                               value="<?=($this->originalInput('lastname') != '') ? $this->escape($this->originalInput('lastname')) : $this->escape($profil->getLastName()) ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <?=$this->getTrans('profileGender'); ?>
                    </label>
                    <div class="col-lg-2">
                        <select class="form-control" id="gender" name="gender">
                            <option value="0" <?=($this->originalInput('gender') != '' AND $this->originalInput('gender') == 0) ? "selected='selected'" : ($profil->getGender() == 0) ? "selected='selected'" : '' ?>><?=$this->getTrans('profileGenderUnknow') ?></option>
                            <option value="1" <?=($this->originalInput('gender') != '' AND $this->originalInput('gender') == 1) ? "selected='selected'" : ($profil->getGender() == 1) ? "selected='selected'" : '' ?>><?=$this->getTrans('profileGenderMale') ?></option>
                            <option value="2"><?=$this->getTrans('profileGenderFemale') ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group <?=$this->validation()->hasError('homepage') ? 'has-error' : '' ?>">
                    <label class="col-lg-2 control-label">
                        <?=$this->getTrans('profileHomepage'); ?>
                    </label>
                    <div class="col-lg-8">
                       <input type="text"
                              class="form-control"
                              name="homepage"
                              placeholder="<?=$this->escape($profil->getHomepage()) ?>"
                              value="<?=($this->originalInput('homepage') != '') ? $this->escape($this->originalInput('homepage')) : $this->escape($profil->getHomepage()) ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <?=$this->getTrans('profileFacebook'); ?>
                    </label>
                    <div class="col-lg-8">
                       <input type="text"
                              class="form-control"
                              name="facebook"
                              placeholder="<?=$this->escape($profil->getFacebook()) ?>"
                              value="<?=($this->originalInput('facebook') != '') ? $this->escape($this->originalInput('facebook')) : $this->escape($profil->getFacebook()) ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <?=$this->getTrans('profileTwitter'); ?>
                    </label>
                    <div class="col-lg-8">
                       <input type="text"
                              class="form-control"
                              name="twitter"
                              placeholder="<?=$this->escape($profil->getTwitter()) ?>"
                              value="<?=($this->originalInput('twitter') != '') ? $this->escape($this->originalInput('twitter')) : $this->escape($profil->getTwitter()) ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <?=$this->getTrans('profileGoogle'); ?>
                    </label>
                    <div class="col-lg-8">
                       <input type="text"
                              class="form-control"
                              name="google"
                              placeholder="<?=$this->escape($profil->getGoogle()) ?>"
                              value="<?=($this->originalInput('google') != '') ? $this->escape($this->originalInput('google')) : $this->escape($profil->getGoogle()) ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <?=$this->getTrans('profileSteam'); ?>
                    </label>
                    <div class="col-lg-8">
                       <input type="text"
                              class="form-control"
                              name="steam"
                              placeholder="<?=$this->escape($profil->getSteam()) ?>"
                              value="<?=($this->originalInput('steam') != '') ? $this->escape($this->originalInput('steam')) : $this->escape($profil->getSteam()) ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <?=$this->getTrans('profileTwitch'); ?>
                    </label>
                    <div class="col-lg-8">
                       <input type="text"
                              class="form-control"
                              name="twitch"
                              placeholder="<?=$this->escape($profil->getTwitch()) ?>"
                              value="<?=($this->originalInput('twitch') != '') ? $this->escape($this->originalInput('twitch')) : $this->escape($profil->getTwitch()) ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <?=$this->getTrans('profileTeamspeak'); ?>
                    </label>
                    <div class="col-lg-8">
                       <input type="text"
                              class="form-control"
                              name="teamspeak"
                              placeholder="<?=$this->escape($profil->getTeamspeak()) ?>"
                              value="<?=($this->originalInput('teamspeak') != '') ? $this->escape($this->originalInput('teamspeak')) : $this->escape($profil->getTeamspeak()) ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <?=$this->getTrans('profileDiscord'); ?>
                    </label>
                    <div class="col-lg-8">
                       <input type="text"
                              class="form-control"
                              name="discord"
                              placeholder="<?=$this->escape($profil->getDiscord()) ?>"
                              value="<?=($this->originalInput('discord') != '') ? $this->escape($this->originalInput('discord')) : $this->escape($profil->getDiscord()) ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <?=$this->getTrans('profileCity'); ?>
                    </label>
                    <div class="col-lg-8">
                       <input type="text"
                              class="form-control"
                              name="city"
                              placeholder="<?=$this->escape($profil->getCity()) ?>"
                              value="<?=($this->originalInput('city') != '') ? $this->escape($this->originalInput('city')) : $this->escape($profil->getCity()) ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <?=$this->getTrans('profileBirthday'); ?>
                    </label>
                    <div class="col-lg-2 input-group ilch-date date form_datetime">
                        <input type="text"
                               class="form-control"
                               name="birthday"
                               value="<?php if ($profil->getBirthday() != '') { echo $birthday->format('d.m.Y'); } else { echo ''; } ?>">
                        <span class="input-group-addon">
                            <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
                <?php
                foreach ($profileFields as $profileField) :
                    $profileFieldName = $profileField->getName();
                    foreach ($profileFieldsTranslation as $profileFieldTranslation) {
                        if($profileField->getId() == $profileFieldTranslation->getFieldId()) {
                            $profileFieldName = $profileFieldTranslation->getName();
                            break;
                        }
                    }
                    
                    if(!$profileField->getType()) :
                        $value = '';
                        $index = 'profileField'.$profileField->getId();
                        if ($this->originalInput($index) != '') {
                            $value = $this->escape($this->originalInput($index));
                        } else {
                            foreach($profileFieldsContent as $profileFieldContent) {
                                if($profileField->getId() == $profileFieldContent->getFieldId()) {
                                    $value = $this->escape($profileFieldContent->getValue());
                                    break;
                                }
                            }
                        } ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">
                                <?=$this->escape($profileFieldName) ?>
                            </label>
                            <div class="col-lg-8">
                               <input type="text"
                                      class="form-control"
                                      name="<?=$index ?>"
                                      placeholder="<?=$value ?>"
                                      value="<?=$value ?>" />
                            </div>
                        </div>
                    <?php else : ?>
                        <h1><?=$this->escape($profileFieldName) ?></h1>
                    <?php endif;
                endforeach; ?>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-8">
                        <input type="submit"
                               class="btn"
                               name="saveEntry"
                               value="<?=$this->getTrans('profileSubmit') ?>" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?=$this->getStaticUrl('js/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>" charset="UTF-8"></script>
<?php if (substr($this->getTranslator()->getLocale(), 0, 2) != 'en'): ?>
    <script src="<?=$this->getStaticUrl('js/datetimepicker/js/locales/bootstrap-datetimepicker.'.substr($this->getTranslator()->getLocale(), 0, 2).'.js') ?>" charset="UTF-8"></script>
<?php endif; ?>
<script>
$(document).ready(function() {
    $(".form_datetime").datetimepicker({
        defaultDate: new Date(),
        endDate: new Date(),
        format: "dd.mm.yyyy",
        autoclose: true,
        language: '<?=substr($this->getTranslator()->getLocale(), 0, 2) ?>',
        minView: 2,
        todayHighlight: true
    });
});
</script>
