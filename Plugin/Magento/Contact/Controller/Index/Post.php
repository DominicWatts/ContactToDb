<?php

namespace Xigen\ContactToDb\Plugin\Magento\Contact\Controller\Index;

/**
 * Post class
 */
class Post
{
    /**
     * afterExecute method
     * @param Post $subject
     * @param type $result
     * @return type
     * @access public
     */
    public function afterExecute(
        \Magento\Contact\Controller\Index\Post $subject,
        $result
    ) {
        //Your plugin code
        return $result;
    }
}
