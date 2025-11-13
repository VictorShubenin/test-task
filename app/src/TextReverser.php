<?php

namespace App;

class TextReverser
{
	/**
	 * Reverse the order of letters in each word while preserving:
	 * - Case (uppercase/lowercase) positions
	 * - Punctuation and non-letter characters positions
	 * - Hyphens and apostrophes as word separators

	 * @param string $text Input string to process
	 * @return string String with words reversed while preserving case and punctuation
	 */
	public function reverseWordsInString(string $text): string
	{
		$result = '';
		$word = '';

		for ($i = 0; $i < mb_strlen($text); $i++) {
			$char = mb_substr($text, $i, 1);

			if ($this->isWordCharacter($char)) {
				$word .= $char;
			} else {
				if ($word !== '') {
					$result .= $this->reverseWord($word);
					$word = '';
				}
				$result .= $char;
			}
		}

		if ($word !== '') {
			$result .= $this->reverseWord($word);
		}

		return $result;
	}

	private function isWordCharacter(string $char): bool
	{
		return preg_match('/[\p{L}\d]/u', $char) || in_array($char, ["'", "`", "-"]);
	}

	private function reverseWord(string $word): string
	{
		$result = '';
		$currentPart = '';

		for ($i = 0; $i < mb_strlen($word); $i++) {
			$char = mb_substr($word, $i, 1);

			if (preg_match('/[\p{L}\d]/u', $char)) {
				$currentPart .= $char;
			} else {
				if ($currentPart !== '') {
					$result .= $this->reverseString($currentPart);
					$currentPart = '';
				}
				$result .= $char;
			}
		}

		if ($currentPart !== '') {
			$result .= $this->reverseString($currentPart);
		}

		return $result;
	}

	private function reverseString(string $str): string
	{
		$reversed = '';
		$length = mb_strlen($str);

		for ($i = $length - 1; $i >= 0; $i--) {
			$reversed .= mb_substr($str, $i, 1);
		}

		$result = '';
		for ($i = 0; $i < $length; $i++) {
			$originalChar = mb_substr($str, $i, 1);
			$reversedChar = mb_substr($reversed, $i, 1);

			if (mb_strtolower($originalChar) === $originalChar) {
				$result .= mb_strtolower($reversedChar);
			} else {
				$result .= mb_strtoupper($reversedChar);
			}
		}

		return $result;
	}
}
