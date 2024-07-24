<!-- Google Tag Manager -->
<script>
  (function(w, d, s, l, i) {
    w[l] = w[l] || [];
    w[l].push({
      'gtm.start': new Date().getTime(),
      event: 'gtm.js'
    });
    var f = d.getElementsByTagName(s)[0],
      j = d.createElement(s),
      dl = l != 'dataLayer' ? '&l=' + l : '';
    j.async = true;
    j.src =
      'SECRET' + i + dl;
    f.parentNode.insertBefore(j, f);
  })(window, document, 'script', 'dataLayer', 'SECRET');
</script>
<!-- End Google Tag Manager -->

<!-- Smartlook -->
<script type='text/javascript'>
  window.smartlook || (function(d) {
    var o = smartlook = function() {
        o.api.push(arguments)
      },
      h = d.getElementsByTagName('head')[0];
    var c = d.createElement('script');
    o.api = new Array();
    c.async = true;
    c.type = 'text/javascript';
    c.charset = 'utf-8';
    c.src = 'SECRET';
    h.appendChild(c);
  })(document);
  smartlook('init', 'SECRET', {
    region: 'eu'
  });
</script>
<!-- End Smartlook -->