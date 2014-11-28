<?php

require_once ('sessioning.php');

/**
 * 
 * question is a array with [descriptio,
 */
function poll_create($description, $privacy, $questions) {
    // verifies if there is a user logged in 
    /*if (user_who() !== null) {
        // creates poll   
        $poll = new Poll();
        $poll->setDescription($description);
        $poll->setDescription($privacy);
        
                if (!) {
            return 'NOT_VALID_DESCRIPTION';
        }
        if (!) {
            return 'NOT_VALID_PRIVACY_VALUE';
        }
        foreach($questions as $question){
            $question = new Question();
            if($question->setDescription($description)){
                
            }
            
        }
    } else {
        return 'USER_NOT_LOGGED_IN';
    }*/
    // for each question , for each answer
    //       creates question
    //       creates answer and add it to the question
    // adds question to the poll
    // calls db insert poll 
}

function poll_delete($pollId) {
    // verifies if poll exists
    // if current user is it's owner
    // calls db delete poll.
}

/**
 * 
 * @param integer $pollId 
 * @param array $answers Array of answers. answer is an array of questionId and answerId
 */
function poll_vote($pollId, $answers) {
    // verifies if user is logged in
    // verifies if poll exists
    // verifies if user already voted on that poll
    // foreach question, for each answer
    // verfies if question belongs to poll
    // verifies if answer belongs to question
    // votes on the poll.
}

/**
 * 
 */
function poll_update() {
    
}
