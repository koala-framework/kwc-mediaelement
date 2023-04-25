<?php
class Mediaelement_Kwc_VideoPlayer_Events extends Kwc_Abstract_Events
{
    protected function _fireMediaChanged(Kwf_Component_Data $c, $type)
    {
        $this->fireEvent(new Kwf_Events_Event_Media_Changed(
            $this->_class, $c, $type
        ));
    }

    protected function _onOwnRowUpdate(Kwf_Component_Data $c, Kwf_Events_Event_Row_Abstract $event)
    {
        if ($event->isDirty("source_type")) {
            // correctly identify a has-content on source_type change would bring to few benefit, always throw event
            $this->fireEvent(new Kwf_Component_Event_Component_HasContentChanged($this->_class, $c));

        } else if ($event->row->source_type == "files" && $event->isDirty("mp4_kwf_upload_id")) {
            if ($event->row->mp4_kwf_upload_id === null
                || $event->row->getCleanValue("mp4_kwf_upload_id") === null
            ) {
                $this->fireEvent(new Kwf_Component_Event_Component_HasContentChanged($this->_class, $c));
            }
        } else if ($event->row->source_type == "links" && $event->isDirty("mp4_url")) {
            if ($event->row->mp4_url === ""
                || $event->row->getCleanValue("mp4_url") === ""
            ) {
                $this->fireEvent(new Kwf_Component_Event_Component_HasContentChanged($this->_class, $c));
            }
        }
    }

    //gets called when own row gets updated, weather component is visible or not
    protected function _onOwnRowUpdateNotVisible(Kwf_Component_Data $c, Kwf_Events_Event_Row_Abstract $event)
    {
        parent::_onOwnRowUpdateNotVisible($c, $event);
        if ($event->isDirty(array('video_width', 'video_height'))) {
            $this->fireEvent(new Kwf_Component_Event_Component_ContentWidthChanged(
                $this->_class, $c
            ));
        }
        if ($event->isDirty(array('mp4_kwf_upload_id'))) {
            $this->_fireMediaChanged($c, 'mp4');
        }
        //content changed
        foreach (Kwf_Component_Data_Root::getInstance()
            ->getComponentsByDbId($event->row->component_id) as $c) {
            $this->fireEvent(new Kwf_Component_Event_Component_ContentChanged(
                $this->_class, $c
            ));
        }
    }
}
