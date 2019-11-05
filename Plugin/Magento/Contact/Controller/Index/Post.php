<?php

namespace Xigen\ContactToDb\Plugin\Magento\Contact\Controller\Index;

class Post
{
    public function afterExecute(
        \Magento\Contact\Controller\Index\Post $subject,
        $result
    ) {
        //Your plugin code
        return $result;
    }
}
