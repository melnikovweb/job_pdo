<?php

/**
 * Hook to filter the oEmbed result and defer video source to data attribute.
 *
 * @param string $data The oEmbed data.
 * @param string $url The URL of the oEmbed.
 * @param array $args The arguments passed to the oEmbed request.
 *
 * @return string The modified oEmbed data with deferred video source.
 */
add_filter('oembed_result', 'defer_video_src_to_data', 99, 3);

/**
 * Hook to filter the oEmbed HTML and defer video source to data attribute.
 *
 * @param string $data The oEmbed HTML.
 * @param string $url The URL of the oEmbed.
 * @param array $args The arguments passed to the oEmbed request.
 *
 * @return string The modified oEmbed HTML with deferred video source.
 */
add_filter('embed_oembed_html', 'defer_video_src_to_data', 99, 3);

/**
 * Defer video source to data attribute in the provided data.
 *
 * @param string $data The oEmbed data.
 * @param string $url The URL of the oEmbed.
 * @param array $args The arguments passed to the oEmbed request.
 *
 * @return string The modified oEmbed data with deferred video source.
 */
function defer_video_src_to_data($data, $url, $args)
{
  $data = preg_replace('/(src="([^\"\']+)")/', 'src="" data-src-defer="$2"', $data);
  return $data;
}
