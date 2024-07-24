<?php

namespace ExcerptFilter;

class ExcerptOptions
{
	const ELLIPSIS = '...';
	const MAX_WORDS = 30;
}

function excerpt_more()
{
	return ExcerptOptions::ELLIPSIS;
}

function excerpt_length()
{
	return ExcerptOptions::MAX_WORDS;
}

add_filter('excerpt_length', 'ExcerptFilter\excerpt_length');
add_filter('excerpt_more', 'ExcerptFilter\excerpt_more');
