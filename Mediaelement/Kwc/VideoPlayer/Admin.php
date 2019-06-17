<?php
class Mediaelement_Kwc_VideoPlayer_Admin extends Kwc_Abstract_Composite_Admin
{
    public function componentToString(Kwf_Component_Data $data)
    {
        $row = $data->getComponent()->getRow();
        if ($row->source_type == 'files') {
            if ($row->getParentRow('FileMp4')) {
                return $row->getParentRow('FileMp4')->filename.'.'.$row->getParentRow('FileMp4')->extension;
            }
        } else {
            if ($row->mp4_url) return $row->mp4_url;
        }
        return '';
    }
}
