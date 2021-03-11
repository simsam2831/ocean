<?php

namespace App\Entity;

use App\Repository\QuestionEventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionEventRepository::class)
 */
class QuestionEvent extends Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=AnswerProposition::class, mappedBy="questionEvent", orphanRemoval=true)
     */
    private $answerPropositions;

    public function __construct()
    {
        parent::__construct();
        $this->answerPropositions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|AnswerProposition[]
     */
    public function getAnswerPropositions(): Collection
    {
        return $this->answerPropositions;
    }

    public function addAnswerProposition(AnswerProposition $answerProposition): self
    {
        if (!$this->answerPropositions->contains($answerProposition)) {
            $this->answerPropositions[] = $answerProposition;
            $answerProposition->setQuestionEvent($this);
        }

        return $this;
    }

    public function removeAnswerProposition(AnswerProposition $answerProposition): self
    {
        if ($this->answerPropositions->removeElement($answerProposition)) {
            // set the owning side to null (unless already changed)
            if ($answerProposition->getQuestionEvent() === $this) {
                $answerProposition->setQuestionEvent(null);
            }
        }

        return $this;
    }
}
