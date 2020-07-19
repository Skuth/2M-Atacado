let version = "1-20-07-19"
let staticCacheName = "2m-atacado-cache-"+version

self.addEventListener("install", e => {
  self.skipWaiting()
  e.waitUntil(
    caches.open(staticCacheName)
      .then(cache => {
        return cache.addAll([
          "/offline",
          "./assets/css/style.min.css",
          "./assets/css/icofont.min.css",
          "./assets/js/script.min.js",
          "https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
        ])
      })
  )
})

self.addEventListener("activate", e => {
  e.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (staticCacheName !== cacheName) {
            return caches.delete(cacheName)
          }
        })
      )
    })
  )
})

self.addEventListener("fetch", e => {
  e.respondWith(
    caches.match(e.request)
      .then(response => {
        return response || fetch(e.request)
      })
      .catch(() => {
        return caches.match("/offline")
      })
  )
})