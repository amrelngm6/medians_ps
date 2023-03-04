import { d as __vue_normalize__, e as __vue_create_injector__ } from './index-44f58245.js';
import 'vue';

//
var script = {
  props: ['device', 'constructedEvents', 'temporaryEvent'],
  inject: ['kalendar_options'],
  components: {
    KalendarEvent: function KalendarEvent() {
      return import('./kalendar-event-deaa86fb.js');
    }
  },
  computed: {
    cell_events: function cell_events() {
      var all_events = [];
      if (this.constructedEvents && this.constructedEvents.length) {
        for (var i = this.constructedEvents.length - 1; i >= 0; i--) {
          if (this.constructedEvents[i] && this.constructedEvents[i].start == this.cellData.time) {
            all_events[i] = this.constructedEvents[i];
          }
        }
      }
      return all_events;
    },
    completed_events: function completed_events() {
      return this.constructedEvents && this.constructedEvents.hasOwnProperty(this.cellData.value) && this.constructedEvents[this.cellData.value];
    },
    overlappingEvents: function overlappingEvents() {
      var _this = this;
      if (!this.constructedEvents || this.cell_events.length < 1) return [];
      return Object.values(this.constructedEvents).flat().filter(function (event) {
        var cellDate = new Date(_this.cellData.value);
        var eventStarts = new Date(event.start);
        var eventEnds = new Date(event.end);
        return eventStarts < cellDate && eventEnds > cellDate;
      });
    },
    overlapValue: function overlapValue() {
      var length = this.overlappingEvents.length;
      return length > 2 ? 2 : length;
    },
    selected: function selected() {
      return this.cell_events && this.cell_events.length > 0;
    },
    hasPopups: function hasPopups() {
      return this.selected && !!this.cell_events.find(function (ev) {
        return ev && ev.status === 'active';
      });
    }
  },
  methods: {
    mouseUp: function mouseUp() {
      this.log('Mouse up');
    },
    resetCreator: function resetCreator() {
      this.$emit('reset');
    },
    isAnHour: function isAnHour(index) {
      if (this.kalendar_options.hourlySelection) {
        return true;
      } else {
        return (index + 1) % (60 / 10) === 0;
      }
    },
    show_modal: function show_modal() {
      var item = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      this.$parent.show_modal(item);
    },
    log: function log(data) {
      this.$parent.log(data);
    }
  }
};

/* script */
var __vue_script__ = script;

/* template */
var __vue_render__ = function __vue_render__() {
  var _vm = this;
  var _h = _vm.$createElement;
  var _c = _vm._self._c || _h;
  return _c('div', {
    staticClass: "kalendar-cell rounded relative",
    class: {
      selected: _vm.selected,
      'is-an-hour': _vm.isAnHour(_vm.index),
      'has-events': _vm.cell_events && _vm.cell_events.length > 0,
      'being-created': !!_vm.being_created || _vm.hasPopups
    },
    style: "\n  height: " + _vm.kalendar_options.cell_height + "px;\n"
  }, [_c('div', _vm._l(_vm.cell_events, function (event, eventIndex) {
    return _vm.cell_events && _vm.cell_events.length && event ? _c('KalendarEvent', {
      key: eventIndex,
      style: "z-index: 10",
      attrs: {
        "event": event,
        "total": _vm.cell_events.length,
        "index": eventIndex,
        "overlaps": _vm.overlapValue
      }
    }) : _vm._e();
  }), 1)]);
};
var __vue_staticRenderFns__ = [];

/* style */
var __vue_inject_styles__ = function __vue_inject_styles__(inject) {
  if (!inject) return;
  inject("data-v-6206abb1_0", {
    source: "li{font-size:13px;position:relative}.created-events{height:100%}ul.building-blocks li{z-index:0;border-bottom:dotted 1px var(--odd-cell-border-color)}ul.building-blocks li.first_of_appointment{z-index:1;opacity:1}ul.building-blocks li.is-an-hour{border-bottom:solid 1px var(--table-cell-border-color)}ul.building-blocks li.has-events{z-index:unset}ul.building-blocks li.being-created{z-index:11}",
    map: undefined,
    media: undefined
  });
};
/* scoped */
var __vue_scope_id__ = undefined;
/* module identifier */
var __vue_module_identifier__ = undefined;
/* functional template */
var __vue_is_functional_template__ = false;
/* style inject SSR */

/* style inject shadow dom */

var __vue_component__ = /*#__PURE__*/__vue_normalize__({
  render: __vue_render__,
  staticRenderFns: __vue_staticRenderFns__
}, __vue_inject_styles__, __vue_script__, __vue_scope_id__, __vue_is_functional_template__, __vue_module_identifier__, false, __vue_create_injector__, undefined, undefined);

export default __vue_component__;
