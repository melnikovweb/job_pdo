import { onDomReady } from '@shared/services/dom-services';
import { headerService } from '@shared/services/header-service';
import { useNavigation } from './hooks/navigation';

onDomReady(() => {
  const dropdownItems = [...headerService.mobileHeader.querySelectorAll('li:has(ul)')];

  const { navigationCloseAll } = useNavigation(dropdownItems);

  headerService.burgerButton.addEventListener('click', () => {
    navigationCloseAll();

    headerService.toggleMobileMenu();
  });
});
