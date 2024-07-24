import { onDomReady } from '@shared/services/dom-services';

onDomReady(async () => {
  (($) => {
    $('.one__select-top').on('click', () => {
      $('.one__select').toggleClass('active');
    });
    $('body').on('click', (e) => {
      if (!e.target.closest('.one__select')) {
        $('.one__select').removeClass('active');
      }
    });
    $('.one__select-bot-item').each(function (index) {
      $(this).on('click', () => {
        $('.one__select-bot-item').removeClass('active');
        $(this).addClass('active');
        $('.one__select').removeClass('active');
        $('.one__select-top-title').text($(this).text());
      });
    });

    $('.one__select-bot-item').eq(0).addClass('active');
    $('.one__select-top-title').text($('.one__select-bot-item').eq(0).text());
  })(window.jQuery);
});
