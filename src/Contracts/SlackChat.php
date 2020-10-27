<?php

namespace RouxtAccess\SlackApi\Contracts;

interface SlackChat
{
    public function delete($channel, $ts, $options = []);
    public function meMessage($channel, $text);
//    public function postEphemeral($channel, $text, $options = []); //not implemented
    public function message($channel, $text, $options = []);
    public function postMessage($channel, $text, $options = []);
    public function update($channel, $text, $ts);
}
