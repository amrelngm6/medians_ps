## 🗓 MediansCalendar

You can run the demo locally :
  - git clone https://github.com/amrelngm6/medians_calendar.git
  - cd medians_calendar
  - npm install
  - npm run serve

 The code for the demo app is in `src/serve-dev.vue` - a small but complete calendar app. 
 This is a good place to learn how thing work and a good starting point for your own implementation. 

## 🏁Getting Started

-   Install plugin dependencies from npm

```
npm install  portal-vue -S
```

-   The easiest option is to copy the demo app from `src/serve-dev.vue` into your project and start from that.

Step by Step:

-   Import plugin and its dependencies in your component

```js
import Vue from "vue";
import PortalVue from "portal-vue";
Vue.use(PortalVue);

import { MediansCalendar } from 'medians-calendar-vue';
...
components: {
	MediansCalendar,
	...
},
```

-   Quick start.

```vue
<template>
	<medians-calendar :configuration="calendar_settings" :events.sync="events" />
</template>
<script>
...
data: () => ({
    calendar_settings: {
      style: 'material_design',
      view_type: 'week',
      cell_height: 20,
      scrollToNow: true,
      start_day: new Date().toISOString(),
      read_only: false,
      day_starts_at: 0,
      day_ends_at: 24,
      overlap: true,
      hide_dates: ['2019-10-31'], // Spooky
      hide_days: [6],
      past_event_creation: true
    },
    
    ...
})
</script>
```

### 🎛 MediansCalendar Options
