<?php

/**
 * Created by PhpStorm.
 * User: kant
 * Date: 31/03/15
 * Time: 11:10
 */

namespace Tuto\FFMpeg\Filters\Audio;

use FFMpeg\Filters\Audio as FFMpegFilters;
use FFMpeg\Media\Audio;
use FFMpeg\Format\AudioInterface;

/**
 * Making an audio fadout
 *
 * Class FadeoutFilter
 * @package Tuto\FFMpeg\Filters\Audio
 */
class FadeoutFilter implements FFMpegFilters\AudioFilterInterface
{
    /**
     * Beginning of the fadout
     * @var int
     */
    private $fromSc;

    /**
     * Duration of the fadout
     * @var int
     */
    private $durationSc;

    private $priority;

    /**
     * Constructor
     *
     * @param int $fromSc
     * @param int $durationSc
     * @param int $priority
     */
    public function __construct($fromSc, $durationSc, $priority = 0)
    {
        $this->fromSc = $fromSc;
        $this->durationSc = $durationSc;
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Audio $audio, AudioInterface $format)
    {
        $from = $this->fromSc;
        $duration = $this->durationSc;

        return array('-af', "afade=t=out:st=$from:d=$duration");
    }
}
