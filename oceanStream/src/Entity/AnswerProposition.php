<?php

namespace App\Entity;

use App\Repository\AnswerPropositionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnswerPropositionRepository::class)
 */
class AnswerProposition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionAnswer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageAnswer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCorrect;

    /**
     * @ORM\Column(type="integer")
     */
    private $fishQuantity;

    /**
     * @ORM\ManyToOne(targetEntity=QuestionEvent::class, inversedBy="answerPropositions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $questionEvent;

    /**
     * @ORM\ManyToOne(targetEntity=Fish::class, inversedBy="answerPropositions")
     */
    private $fish;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionAnswer(): ?string
    {
        return $this->descriptionAnswer;
    }

    public function setDescriptionAnswer(string $descriptionAnswer): self
    {
        $this->descriptionAnswer = $descriptionAnswer;

        return $this;
    }

    public function getImageAnswer(): ?string
    {
        return $this->imageAnswer;
    }

    public function setImageAnswer(string $imageAnswer): self
    {
        $this->imageAnswer = $imageAnswer;

        return $this;
    }

    public function getIsCorrect(): ?bool
    {
        return $this->isCorrect;
    }

    public function setIsCorrect(bool $isCorrect): self
    {
        $this->isCorrect = $isCorrect;

        return $this;
    }

    public function getFishQuantity(): ?int
    {
        return $this->fishQuantity;
    }

    public function setFishQuantity(int $fishQuantity): self
    {
        $this->fishQuantity = $fishQuantity;

        return $this;
    }

    public function getQuestionEvent(): ?QuestionEvent
    {
        return $this->questionEvent;
    }

    public function setQuestionEvent(?QuestionEvent $questionEvent): self
    {
        $this->questionEvent = $questionEvent;

        return $this;
    }

    public function getFish(): ?Fish
    {
        return $this->fish;
    }

    public function setFish(?Fish $fish): self
    {
        $this->fish = $fish;

        return $this;
    }
}
