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


	public function testWordsWithPunctuation()

	{

		$this->assertEquals('tac,', $this->reserver->reverseWordsInString('cat,'));

		$this->assertEquals('Амиз:', $this->reserver->reverseWordsInString('Зима:'));

		$this->assertEquals("si 'dloc' won", $this->reserver->reverseWordsInString("is 'cold' now"));

		$this->assertEquals('отэ «Кат» "отсорп"', $this->reserver->reverseWordsInString('это «Так» "просто"'));
	}


	public function testCompoundWordsWithHyphensAndApostrophes()

	{

		$this->assertEquals('driht-trap', $this->reserver->reverseWordsInString('third-part'));

		$this->assertEquals('nac`t', $this->reserver->reverseWordsInString('can`t'));
	}
}
