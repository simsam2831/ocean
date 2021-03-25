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
    private ?int $id;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $category;

    /**
     * @ORM\ManyToMany(targetEntity=AnswerProposition::class, mappedBy="questionEvents")
     */
    private $answerPropositions;

    private const HISTORY = 'Histoire';
    private const GEOGRAPHY = 'Géographie';
    private const NATURE = 'Nature';
    private const ENIGMA = 'Enigme';
    private const POLLUTION = 'Pollution';

    public function __construct()
    {
        parent::__construct();
        $this->answerPropositions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        if (!in_array($category, array(self::HISTORY, self::GEOGRAPHY,self::NATURE, self::ENIGMA ,self::POLLUTION))) {
            throw new \InvalidArgumentException("Invalid category");
        }
        $this->category = $category;

        return $this;
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
            $answerProposition->addQuestionEvent($this);
        }

        return $this;
    }

    public function removeAnswerProposition(AnswerProposition $answerProposition): self
    {
        if ($this->answerPropositions->removeElement($answerProposition)) {
            $answerProposition->removeQuestionEvent($this);
        }

        return $this;
    }
}
