<?php
class Mediaelement_Kwc_VideoPlayer_Form extends Kwc_Abstract_Composite_Form
{
    protected $_model = 'Mediaelement_Kwc_VideoPlayer_Model';

    public function __construct($name, $class)
    {
        parent::__construct($name, $class);
        $ratios = Kwc_Abstract::getSetting($this->getClass(), 'ratios');

        $cards = $this->fields->add(new Kwf_Form_Container_Cards('source_type', trlKwf('Video Source Type')));
        $cards->getCombobox()->setAllowBlank(false);
        $card = $cards->add();
        $card->setName('files');
        $card->setTitle(trlKwf('Files'));
        $fs = $card->add(new Kwf_Form_Container_FieldSet(trlKwf('Files')));
        $fs->add(new Kwf_Form_Field_File('FileMp4', trlKwf('Mp4 file')))
            ->setDirectory('AdvancedVideoPlayer')
            ->setAllowOnlyImages(false);

        $card = $cards->add();
        $card->setName('links');
        $card->setTitle(trlKwf('Links'));
        $fs = $card->add(new Kwf_Form_Container_FieldSet(trlKwf('Links')));
        $fs->add(new Kwf_Form_Field_UrlField('mp4_url', trlKwf('Mp4 link')))
            ->setWidth(400);

        $fs = $this->fields->add(new Kwf_Form_Container_FieldSet(trlKwf('Settings')))
            ->setHelpText(trlKwf('Insert "100%" in both fields to make it responsive.'));

        $cards = $fs->add(new Kwf_Form_Container_Cards('size', trlKwf('Size')));
        $cards->getCombobox()
            ->setWidth(300)
            ->setListWidth(300)
            ->setAllowBlank(false);

        $card = $cards->add(new Kwf_Form_Container_Card('contentWidth'))
            ->setTitle(trlKwf('Stretch video to maximum width'));
        $card->add(new Kwf_Form_Field_Select('format', trlKwf('Format')))
            ->setValues($ratios)
            ->setDefaultValue('16x9')
            ->setAllowBlank(false);

        $card = $cards->add(new Kwf_Form_Container_Card('userDefined'))
            ->setTitle(trlKwf('Set size of video'));
        $card->add(new Kwf_Form_Field_TextField('video_width', trlKwf('Width (px)')))
            ->setWidth(80);
        $card->add(new Kwf_Form_Field_TextField('video_height', trlKwf('Height (px)')))
            ->setWidth(80);

        $fs->add(new Kwf_Form_Field_Checkbox('loop', trlKwf('Repeat')));
        $fs->add(new Kwf_Form_Field_Checkbox('auto_play', trlKwf('Auto play')));
    }
}
