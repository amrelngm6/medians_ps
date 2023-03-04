import { j as getLocaleTime, k as isBefore, h as getTopDistance, m as addTimezoneInfo, d as __vue_normalize__, e as __vue_create_injector__, n as _defineProperty } from './index-c43ab721.js';
import 'vue';

//
var script = {
  props: ['event', 'total', 'index', 'overlaps', 'column_index'],
  mounted: function mounted() {
    var t = this;
    setTimeout(function () {
      jQuery('#event-' + t.index + ' > .animated').css('opacity', 1);
    }, this.column_index * this.kalendar_options.animation_speed);
  },
  inject: ['kalendar_options'],
  data: function data() {
    return {
      opacity: 0,
      inspecting: false,
      editing: false
    };
  },
  computed: {
    isPast: function isPast() {
      var now = getLocaleTime(new Date().toISOString());
      return isBefore(this.event.start.value, now);
    },
    width_value: function width_value() {
      return "calc(100% - 10px)";
    },
    left_offset: function left_offset() {
      return "10px";
    },
    top_offset: function top_offset() {
      var topDistance = getTopDistance(this.event.from, this.kalendar_options.hourlySelection);
      return topDistance > 0 ? "".concat(topDistance / 10 * this.kalendar_options.cell_height, "px") : "0px";
    },
    distance: function distance() {
      if (!this.event) return;
      var multiplier = this.kalendar_options.cell_height / 10;
      // 0.5 * multiplier for an offset so next cell is easily selected
      return "".concat(this.event.distance * multiplier - 0.2 * multiplier, "px");
    },
    status: function status() {
      return this.event && this.event.status || this.editing;
    },
    information: function information() {
      var _this$event = this.event,
        start = _this$event.start,
        end = _this$event.end,
        data = _this$event.data,
        id = _this$event.id,
        key = _this$event.key;
      var payload = {
        start_time: addTimezoneInfo(start),
        end_time: addTimezoneInfo(end),
        kalendar_id: id,
        key: key,
        data: data
      };
      return payload;
    },
    editEvent: function editEvent() {
      this.$kalendar.closePopups();
      this.editing = true;
    },
    closeEventPopup: function closeEventPopup() {
      this.editing = false;
    }
  },
  methods: {
    mouseUp: function mouseUp() {
      this.show_modal(this.event);
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

var __vue_script__ = script;

/* template */
var __vue_render__ = function __vue_render__() {
  var _class;
  var _vm = this;
  var _h = _vm.$createElement;
  var _c = _vm._self._c || _h;
  return _vm.event ? _c('div', {
    ref: "kalendarEventRef-" + _vm.event.id,
    staticClass: "right-0 left-0 mx-auto event-card cursor-pointer",
    class: (_class = {
      'is-past': _vm.isPast
    }, _defineProperty(_class, "is-past", _vm.isPast), _defineProperty(_class, "overlaps", _vm.overlaps > 0), _defineProperty(_class, 'two-in-one', _vm.total > 1), _defineProperty(_class, "inspecting", !!_vm.inspecting), _defineProperty(_class, 'event-card__mini', _vm.event.distance <= 10), _defineProperty(_class, 'event-card__small', _vm.event.distance > 10 && _vm.event.distance < 40 || _vm.overlaps > 1), _class),
    style: "\n      height: " + _vm.distance + "; \n      width: " + _vm.width_value + "; \n      top: " + _vm.top_offset + ";\n    ",
    attrs: {
      "id": 'event-' + _vm.index
    },
    on: {
      "mouseup": _vm.mouseUp
    }
  }, [_c('div', {
    key: "opacity" + _vm.opacity,
    staticClass: "animated fadeIn rounded-lg px-2 py-3",
    class: _vm.event.classes,
    style: "opacity:" + _vm.opacity
  }, [_c('portal-target', {
    attrs: {
      "name": "event-details",
      "slot-props": _vm.event,
      "slim": ""
    }
  })], 1)]) : _vm._e();
};
var __vue_staticRenderFns__ = [];

/* style */
var __vue_inject_styles__ = function __vue_inject_styles__(inject) {
  if (!inject) return;
  inject("data-v-1d4349aa_0", {
    source: ".event-card{display:flex;flex-direction:column;height:100%;width:100%;position:absolute;top:0;left:0;right:0;bottom:0;color:#fff;user-select:none;will-change:height}.event-card h4,.event-card p,.event-card span{margin:0}.event-card>*{flex:1;position:relative}.event-card.creating{z-index:-1}.event-card.overlaps>*{border:solid 1px #fff!important}.event-card.inspecting{z-index:11!important}.event-card.inspecting .created-event{box-shadow:0 6px 10px 0 rgba(0,0,0,.14),0 1px 18px 0 rgba(0,0,0,.12),0 3px 5px -1px rgba(0,0,0,.2);transition:opacity .1s linear}.event-card__mini .created-event>.details-card>*{display:none}.event-card__mini .appointment-title,.event-card__mini .time{display:block!important;position:absolute;top:0;font-size:9px;z-index:1;overflow:visible;height:100%}.event-card__small .appointment-title{font-size:80%}.event-card__small .time{font-size:70%}.event-card.two-in-one .details-card>*{font-size:60%}.event-card h1,.event-card h2,.event-card h3,.event-card h4,.event-card h5,.event-card h6,.event-card p{margin:0}.time{position:absolute;bottom:0;right:0;font-size:11px}.popup-wrapper{text-shadow:none;color:#000;z-index:10;position:absolute;top:0;left:calc(100% + 5px);display:flex;flex-direction:column;pointer-events:all;user-select:none;background-color:#fff;border:solid 1px rgba(0,0,0,.08);border-radius:4px;box-shadow:0 2px 12px -3px rgba(0,0,0,.3);padding:10px}.popup-wrapper h4{color:#000;font-weight:400}.popup-wrapper input,.popup-wrapper textarea{border:none;background-color:#ebebeb;color:#030303;border-radius:4px;padding:5px 8px;margin-bottom:5px}.created-event{pointer-events:all;position:relative}.created-event>.details-card{max-width:100%;width:100%;overflow:hidden;position:relative;white-space:nowrap;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical}.created-event>.details-card h2,.created-event>.details-card h3,.created-event>.details-card h4,.created-event>.details-card p,.created-event>.details-card small,.created-event>.details-card span,.created-event>.details-card strong,.created-event>.details-card>h1{text-overflow:ellipsis;overflow:hidden;display:block}ul:last-child .popup-wrapper{left:auto;right:100%;margin-right:10px}.day-view ul .popup-wrapper{left:auto;right:auto;width:calc(100% - 10px);top:10px}",
    map: undefined,
    media: undefined
  }), inject("data-v-1d4349aa_1", {
    source: ".animated{opacity:0;transition:all .5s ease-in-out}",
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
