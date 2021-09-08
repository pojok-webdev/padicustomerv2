<?php
function setclass($expectedcondition,$metcondition,$metclass,$unmetclass){
    if($expectedcondition===$metcondition){
        return $metclass;
    }
    return $unmetclass;
}