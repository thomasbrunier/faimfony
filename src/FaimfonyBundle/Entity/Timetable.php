<?php

namespace FaimfonyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timetable
 *
 * @ORM\Table(name="timetable")
 * @ORM\Entity(repositoryClass="FaimfonyBundle\Repository\TimetableRepository")
 */
class Timetable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="day", type="string", length=255)
     */
    protected $day;

    /**
     * @ORM\Column(name="start_time", type="time")
     */
    protected $startTime;

    /**
     * @ORM\Column(name="end_time", type="time")
     */
    protected $endTime;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="timetables")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $timetable;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set day
     *
     * @param string $day
     *
     * @return Timetable
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return string
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return Timetable
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return Timetable
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set timetable
     *
     * @param \FaimfonyBundle\Entity\User $timetable
     *
     * @return Timetable
     */
    public function setTimetable(\FaimfonyBundle\Entity\User $timetable = null)
    {
        $this->timetable = $timetable;

        return $this;
    }

    /**
     * Get timetable
     *
     * @return \FaimfonyBundle\Entity\User
     */
    public function getTimetable()
    {
        return $this->timetable;
    }
}
