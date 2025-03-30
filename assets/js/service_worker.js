const CACHE_NAME = 'wanderwise-cache-v1';
const urlsToCache = [
    '/',  // Add the root path if it's used for your homepage
    '/assets/css/about.css',
    '/assets/css/booking.css',
    '/assets/css/faq.css',
    '/assets/css/footer.css',
    '/assets/css/header.css',
    '/assets/css/home.css',
    '/assets/css/login.css',
    '/assets/css/nearby_facilities.css',
    '/assets/css/packages.css',
    '/assets/css/profile.css',
    '/assets/css/register.css',
    '/assets/css/terms_and_condition.css',
    '/assets/css/total_cost.css',
    '/assets/css/update_profile.css',
    '/assets/js/script.js',
    '/assets/js/service_worker.js',
    '/assets/js/validate_profile_update.js',
    '/assets/js/validate_register.js',
    '/assets/images/logo.png',  // Make sure this file is placed in the correct folder
    '/assets/images/background.jpg',  // Make sure this file is placed in the correct folder
    '/assets/images/favicon.ico'  // Make sure this file is placed in the correct folder
  ];

// Install event to cache files
self.addEventListener('install', function(event) {
  console.log('Service Worker: Installed');
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('Service Worker: Caching Files');
        return cache.addAll(urlsToCache);
      })
  );
});

// Fetch event to serve cached files or fetch from network
self.addEventListener('fetch', function(event) {
  console.log('Service Worker: Fetching', event.request.url);
  event.respondWith(
    caches.match(event.request).then(function(response) {
      return response || fetch(event.request);
    })
  );
});

// Activate event to clean up old caches
self.addEventListener('activate', function(event) {
  const cacheWhitelist = [CACHE_NAME];
  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cacheName) {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
  console.log('Service Worker: Activated');
});
