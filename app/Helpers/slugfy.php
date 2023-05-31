<?php

function slugfy(string $txt)
{
    $text = preg_replace('/[^\p{L}\p{N}]+/u', '-', $txt);
    // Remove espaços em branco extras
    $text = trim($text, '-');
    // Converte para letras minúsculas
    $text = mb_strtolower($text);
    // Remove caracteres não permitidos
    $text = preg_replace('/[^a-z0-9\-]+/', '', $text);

    return $text;
}

function isSlug($text) {
    return preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/i', $text);
  }