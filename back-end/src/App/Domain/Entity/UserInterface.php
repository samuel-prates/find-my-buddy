<?php

interface UserInterface
{
    public function getId(): ?int;

    public function getEmail(): ?string;

    public function getRoles(): array;

    public function getPassword(): ?string;

    public function getName(): ?string;

    public function eraseCredentials(): void;
}