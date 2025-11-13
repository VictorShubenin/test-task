<?php


namespace App\Tests;


use PHPUnit\Framework\TestCase;
use App\TextReverser;


class ReverseWordsTest extends TestCase

{
	protected TextReverser $reserver;

	protected function setUp(): void
	{
		$this->reserver = new TextReverser();
	}


	public function testSimpleWordsWithCasePreservation(): void

	{

		$this->assertEquals('Tac', $this->reserver->reverseWordsInString('Cat'));

		$this->assertEquals('Ьшым', $this->reserver->reverseWordsInString('Мышь'));

		$this->assertEquals('esuOh', $this->reserver->reverseWordsInString('houSe'));

		$this->assertEquals('кимОД', $this->reserver->reverseWordsInString('домИК'));

		$this->assertEquals('tnAhPele', $this->reserver->reverseWordsInString('elEpHant'));
	}


	public function testWordsWithPunctuation(): void

	{

		$this->assertEquals('tac,', $this->reserver->reverseWordsInString('cat,'));

		$this->assertEquals('Амиз:', $this->reserver->reverseWordsInString('Зима:'));

		$this->assertEquals("si 'dloc' won", $this->reserver->reverseWordsInString("is 'cold' now"));

		$this->assertEquals('отэ «Кат» "отсорп"', $this->reserver->reverseWordsInString('это «Так» "просто"'));
	}


	public function testCompoundWordsWithHyphensAndApostrophes(): void

	{

		$this->assertEquals('driht-trap', $this->reserver->reverseWordsInString('third-part'));

		$this->assertEquals('nac`t', $this->reserver->reverseWordsInString('can`t'));
	}

	public function testSpecialCases(): void

	{

		$this->assertEquals('', $this->reserver->reverseWordsInString(''));

		$this->assertEquals(' ', $this->reserver->reverseWordsInString(' '));

		$this->assertEquals('321', $this->reserver->reverseWordsInString('123'));

		$this->assertEquals('-', $this->reserver->reverseWordsInString('-'));

		$this->assertEquals('`', $this->reserver->reverseWordsInString('`'));
	}

	public function testMixedContent(): void

	{

		$this->assertEquals('dlrow olleh', $this->reserver->reverseWordsInString('world hello'));

		$this->assertEquals('siht si a tset', $this->reserver->reverseWordsInString('this is a test'));

		$this->assertEquals('tac, dna dog.', $this->reserver->reverseWordsInString('cat, and god.'));

		$this->assertEquals('54321 dcba', $this->reserver->reverseWordsInString('12345 abcd'));
	}

	public function testComplexQuotes(): void
	{

		$this->assertEquals("'siht' [si] {a} (tset)", $this->reserver->reverseWordsInString("'this' [is] {a} (test)"));

		$this->assertEquals("«test» 'test' \"test\"", $this->reserver->reverseWordsInString("«tset» 'tset' \"tset\""));

		$this->assertEquals("‘test’ “test”", $this->reserver->reverseWordsInString("‘tset’ “tset”"));
	}
}
