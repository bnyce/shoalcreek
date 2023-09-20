<?php

namespace Drupal\apl_webform\Plugin\WebformHandler;

use Drupal\Core\Form\FormStateInterface;
use Drupal\webform\Plugin\WebformHandlerBase;
use Drupal\Component\Utility\Html;
use Drupal\webform\WebformSubmissionInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Webform validate handler.
 *
 * @WebformHandler(
 *   id = "apl_webform_custom_validator",
 *   label = @Translation("Check if reservation overlaps"),
 *   category = @Translation("Settings"),
 *   description = @Translation("Return an error if reservation overlaps."),
 *   cardinality = \Drupal\webform\Plugin\WebformHandlerInterface::CARDINALITY_SINGLE,
 *   results = \Drupal\webform\Plugin\WebformHandlerInterface::RESULTS_PROCESSED,
 *   submission = \Drupal\webform\Plugin\WebformHandlerInterface::SUBMISSION_OPTIONAL,
 * )
 */
class MyWebformHandler extends WebformHandlerBase {

  use StringTranslationTrait;

    /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state, WebformSubmissionInterface $webform_submission) {
    $this->validateTime($form_state);
  }



  /**
   * Validate the reservation does not overlap an existing reservation.
   */
  private function validateTime(FormStateInterface $formState) {
    $room = !empty($formState->getValue('room')) ? Html::escape($formState->getValue('room')) : NULL;

    $mTimeStart = !empty($formState->getValue('time_start')) ? Html::escape($formState->getValue('time_start')) : NULL;
    $mTimeEnd = !empty($formState->getValue('time_end')) ? Html::escape($formState->getValue('time_end')) : NULL;

    
    $response['data'] = 'Some test data to return';
    $current_url = $_SERVER['HTTP_HOST'];

    $mmm_date = substr($mTimeStart,0,10);
    $jsonUrl = 'https://'.$current_url.'/slr_dates2.json?date='. $mmm_date .'&t='. time();

    $response['data'] = file_get_contents($jsonUrl);
    $json = json_decode($response['data'],TRUE);
    $j_room = array();
    $j_start = array();
    $j_end = array();
    $j_name = array();
    $existingStarts_room = array();
    $existingStarts_start = array();
    $existingStarts_end = array();
    $my_overlap = 0;

    for ($k = 0; $k < count($json); $k++) {
          $j_room = $json[$k]["room"];
          $j_start = $json[$k]["start"];
          $j_end = $json[$k]["end"];
          $j_name = $json[$k]["name"];

          array_push($existingStarts_room, $j_room);
	  array_push($existingStarts_start, $j_start);
	  array_push($existingStarts_end, $j_end);
        }

    for ($p = 0; $p < count($existingStarts_start); $p++) {
          //bool overlap = m.start < e.end && e.start < m.end;

          $d_Ends = strtotime($existingStarts_end[$p]);
          $d_Starts = strtotime($existingStarts_start[$p]);
	  
          $room_id2 = $room;
 if (
     ((strtotime($mTimeStart) < $d_Ends) && (strtotime($mTimeEnd) > $d_Starts))
	      || $mTimeStart == $d_Starts
	      || $mTimeEnd == $d_End
	      ) { // overlaps an existing rez, but is it in the same room?
            if ($existingStarts_room[$p] == $room_id2) {
              $my_overlap = 1;

	    }
          }

        }
          if ($my_overlap == '1') {
	     $formState->setErrorByName('room', $this->t('Please select an available date and time for your reservation.'));
          } 


    
    if (empty($mTimeStart) || is_array($mTimeStart) || empty($mTimeEnd) || is_array($mTimeEnd)) {
            $formState->setErrorByName('reservation_date', $this->t('Please select an available date and time for your reservation.'));
    }

  }


  
}
