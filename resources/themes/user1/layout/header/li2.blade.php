
  <li>
      <a class="has-arrow " href="javascript:void()" aria-expanded="false">
          <i class="{{ $icon }}"></i>
          <span class="nav-text">{{ $name }}</span>
      </a>
      <ul aria-expanded="false">
          {{ $slot }}
      </ul>
  </li>
