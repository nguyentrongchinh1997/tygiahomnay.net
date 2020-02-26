<?php

function format($string)
{
	if (is_numeric($string)) {
		return number_format($string, 2, ',', '.');
	} else {
		return $string
	}
}