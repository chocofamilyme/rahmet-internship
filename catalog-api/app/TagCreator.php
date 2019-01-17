<?php


namespace App;

class TagCreator
{

    public static function validateTag($title){

        $title = preg_replace('/[^\d\w]/', '-', $title);

        $title = strtolower($title);

        $title = preg_replace('/-{2,}/', '-', $title);

        $title = trim($title);
        $title = trim($title, '-');

        return $title;
    }

    public static function createTag($user, $titles){

        $ids = array();

        foreach($titles as $title){
            
            $title = self::validateTag($title);

            if(Tag::all()->where('title', $title)->count() == 0){
                
                Tag::create(['title'=>$title, 'user_id'=>$user->id]);
                $tag = Tag::all()->last();
                $ids[] = $tag->id;
            }
        }

        return $ids;

    }
}