<?php
class Mediaelement_Kwc_VideoPlayer_ApiContent implements Kwf_Component_ApiContent_Interface
{
    public function getContent(Kwf_Component_Data $data)
    {
        $ret = array();
        $row = $data->getComponent()->getRow();
        if ($row->source_type === 'files') {
            $ret['videoUrl'] = $data->getComponent()->getVideoUrl();
        } else if ($row->source_type === 'links') {
            $ret['videoUrl'] = $row->mp4_url;
        }
        if ($row->size == 'userDefined') {
            $ret['videoWidth'] = $row->video_width;
            $ret['videoHeight'] = $row->video_height;
        }
        $ret['autoPlay'] = !!$row->auto_play;
        $ret['loop'] = !!$row->loop;
        $ret['format'] = $row->format;
        $ret['previewImage'] = $data->getChildComponent('-previewImage');
        return $ret;
    }
}
