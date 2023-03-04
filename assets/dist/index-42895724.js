import Vue from 'vue';

function _iterableToArrayLimit(arr, i) {
  var _i = null == arr ? null : "undefined" != typeof Symbol && arr[Symbol.iterator] || arr["@@iterator"];
  if (null != _i) {
    var _s,
      _e,
      _x,
      _r,
      _arr = [],
      _n = !0,
      _d = !1;
    try {
      if (_x = (_i = _i.call(arr)).next, 0 === i) {
        if (Object(_i) !== _i) return;
        _n = !1;
      } else for (; !(_n = (_s = _x.call(_i)).done) && (_arr.push(_s.value), _arr.length !== i); _n = !0);
    } catch (err) {
      _d = !0, _e = err;
    } finally {
      try {
        if (!_n && null != _i.return && (_r = _i.return(), Object(_r) !== _r)) return;
      } finally {
        if (_d) throw _e;
      }
    }
    return _arr;
  }
}
function ownKeys(object, enumerableOnly) {
  var keys = Object.keys(object);
  if (Object.getOwnPropertySymbols) {
    var symbols = Object.getOwnPropertySymbols(object);
    enumerableOnly && (symbols = symbols.filter(function (sym) {
      return Object.getOwnPropertyDescriptor(object, sym).enumerable;
    })), keys.push.apply(keys, symbols);
  }
  return keys;
}
function _objectSpread2(target) {
  for (var i = 1; i < arguments.length; i++) {
    var source = null != arguments[i] ? arguments[i] : {};
    i % 2 ? ownKeys(Object(source), !0).forEach(function (key) {
      _defineProperty(target, key, source[key]);
    }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) {
      Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key));
    });
  }
  return target;
}
function _regeneratorRuntime() {
  _regeneratorRuntime = function () {
    return exports;
  };
  var exports = {},
    Op = Object.prototype,
    hasOwn = Op.hasOwnProperty,
    defineProperty = Object.defineProperty || function (obj, key, desc) {
      obj[key] = desc.value;
    },
    $Symbol = "function" == typeof Symbol ? Symbol : {},
    iteratorSymbol = $Symbol.iterator || "@@iterator",
    asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator",
    toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag";
  function define(obj, key, value) {
    return Object.defineProperty(obj, key, {
      value: value,
      enumerable: !0,
      configurable: !0,
      writable: !0
    }), obj[key];
  }
  try {
    define({}, "");
  } catch (err) {
    define = function (obj, key, value) {
      return obj[key] = value;
    };
  }
  function wrap(innerFn, outerFn, self, tryLocsList) {
    var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator,
      generator = Object.create(protoGenerator.prototype),
      context = new Context(tryLocsList || []);
    return defineProperty(generator, "_invoke", {
      value: makeInvokeMethod(innerFn, self, context)
    }), generator;
  }
  function tryCatch(fn, obj, arg) {
    try {
      return {
        type: "normal",
        arg: fn.call(obj, arg)
      };
    } catch (err) {
      return {
        type: "throw",
        arg: err
      };
    }
  }
  exports.wrap = wrap;
  var ContinueSentinel = {};
  function Generator() {}
  function GeneratorFunction() {}
  function GeneratorFunctionPrototype() {}
  var IteratorPrototype = {};
  define(IteratorPrototype, iteratorSymbol, function () {
    return this;
  });
  var getProto = Object.getPrototypeOf,
    NativeIteratorPrototype = getProto && getProto(getProto(values([])));
  NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype);
  var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype);
  function defineIteratorMethods(prototype) {
    ["next", "throw", "return"].forEach(function (method) {
      define(prototype, method, function (arg) {
        return this._invoke(method, arg);
      });
    });
  }
  function AsyncIterator(generator, PromiseImpl) {
    function invoke(method, arg, resolve, reject) {
      var record = tryCatch(generator[method], generator, arg);
      if ("throw" !== record.type) {
        var result = record.arg,
          value = result.value;
        return value && "object" == typeof value && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) {
          invoke("next", value, resolve, reject);
        }, function (err) {
          invoke("throw", err, resolve, reject);
        }) : PromiseImpl.resolve(value).then(function (unwrapped) {
          result.value = unwrapped, resolve(result);
        }, function (error) {
          return invoke("throw", error, resolve, reject);
        });
      }
      reject(record.arg);
    }
    var previousPromise;
    defineProperty(this, "_invoke", {
      value: function (method, arg) {
        function callInvokeWithMethodAndArg() {
          return new PromiseImpl(function (resolve, reject) {
            invoke(method, arg, resolve, reject);
          });
        }
        return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg();
      }
    });
  }
  function makeInvokeMethod(innerFn, self, context) {
    var state = "suspendedStart";
    return function (method, arg) {
      if ("executing" === state) throw new Error("Generator is already running");
      if ("completed" === state) {
        if ("throw" === method) throw arg;
        return doneResult();
      }
      for (context.method = method, context.arg = arg;;) {
        var delegate = context.delegate;
        if (delegate) {
          var delegateResult = maybeInvokeDelegate(delegate, context);
          if (delegateResult) {
            if (delegateResult === ContinueSentinel) continue;
            return delegateResult;
          }
        }
        if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) {
          if ("suspendedStart" === state) throw state = "completed", context.arg;
          context.dispatchException(context.arg);
        } else "return" === context.method && context.abrupt("return", context.arg);
        state = "executing";
        var record = tryCatch(innerFn, self, context);
        if ("normal" === record.type) {
          if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue;
          return {
            value: record.arg,
            done: context.done
          };
        }
        "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg);
      }
    };
  }
  function maybeInvokeDelegate(delegate, context) {
    var methodName = context.method,
      method = delegate.iterator[methodName];
    if (undefined === method) return context.delegate = null, "throw" === methodName && delegate.iterator.return && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method) || "return" !== methodName && (context.method = "throw", context.arg = new TypeError("The iterator does not provide a '" + methodName + "' method")), ContinueSentinel;
    var record = tryCatch(method, delegate.iterator, context.arg);
    if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel;
    var info = record.arg;
    return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel);
  }
  function pushTryEntry(locs) {
    var entry = {
      tryLoc: locs[0]
    };
    1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry);
  }
  function resetTryEntry(entry) {
    var record = entry.completion || {};
    record.type = "normal", delete record.arg, entry.completion = record;
  }
  function Context(tryLocsList) {
    this.tryEntries = [{
      tryLoc: "root"
    }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0);
  }
  function values(iterable) {
    if (iterable) {
      var iteratorMethod = iterable[iteratorSymbol];
      if (iteratorMethod) return iteratorMethod.call(iterable);
      if ("function" == typeof iterable.next) return iterable;
      if (!isNaN(iterable.length)) {
        var i = -1,
          next = function next() {
            for (; ++i < iterable.length;) if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next;
            return next.value = undefined, next.done = !0, next;
          };
        return next.next = next;
      }
    }
    return {
      next: doneResult
    };
  }
  function doneResult() {
    return {
      value: undefined,
      done: !0
    };
  }
  return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, "constructor", {
    value: GeneratorFunctionPrototype,
    configurable: !0
  }), defineProperty(GeneratorFunctionPrototype, "constructor", {
    value: GeneratorFunction,
    configurable: !0
  }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) {
    var ctor = "function" == typeof genFun && genFun.constructor;
    return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name));
  }, exports.mark = function (genFun) {
    return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun;
  }, exports.awrap = function (arg) {
    return {
      __await: arg
    };
  }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () {
    return this;
  }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) {
    void 0 === PromiseImpl && (PromiseImpl = Promise);
    var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl);
    return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) {
      return result.done ? result.value : iter.next();
    });
  }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () {
    return this;
  }), define(Gp, "toString", function () {
    return "[object Generator]";
  }), exports.keys = function (val) {
    var object = Object(val),
      keys = [];
    for (var key in object) keys.push(key);
    return keys.reverse(), function next() {
      for (; keys.length;) {
        var key = keys.pop();
        if (key in object) return next.value = key, next.done = !1, next;
      }
      return next.done = !0, next;
    };
  }, exports.values = values, Context.prototype = {
    constructor: Context,
    reset: function (skipTempReset) {
      if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined);
    },
    stop: function () {
      this.done = !0;
      var rootRecord = this.tryEntries[0].completion;
      if ("throw" === rootRecord.type) throw rootRecord.arg;
      return this.rval;
    },
    dispatchException: function (exception) {
      if (this.done) throw exception;
      var context = this;
      function handle(loc, caught) {
        return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught;
      }
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i],
          record = entry.completion;
        if ("root" === entry.tryLoc) return handle("end");
        if (entry.tryLoc <= this.prev) {
          var hasCatch = hasOwn.call(entry, "catchLoc"),
            hasFinally = hasOwn.call(entry, "finallyLoc");
          if (hasCatch && hasFinally) {
            if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0);
            if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc);
          } else if (hasCatch) {
            if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0);
          } else {
            if (!hasFinally) throw new Error("try statement without catch or finally");
            if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc);
          }
        }
      }
    },
    abrupt: function (type, arg) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) {
          var finallyEntry = entry;
          break;
        }
      }
      finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null);
      var record = finallyEntry ? finallyEntry.completion : {};
      return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record);
    },
    complete: function (record, afterLoc) {
      if ("throw" === record.type) throw record.arg;
      return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel;
    },
    finish: function (finallyLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel;
      }
    },
    catch: function (tryLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc === tryLoc) {
          var record = entry.completion;
          if ("throw" === record.type) {
            var thrown = record.arg;
            resetTryEntry(entry);
          }
          return thrown;
        }
      }
      throw new Error("illegal catch attempt");
    },
    delegateYield: function (iterable, resultName, nextLoc) {
      return this.delegate = {
        iterator: values(iterable),
        resultName: resultName,
        nextLoc: nextLoc
      }, "next" === this.method && (this.arg = undefined), ContinueSentinel;
    }
  }, exports;
}
function _typeof(obj) {
  "@babel/helpers - typeof";

  return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) {
    return typeof obj;
  } : function (obj) {
    return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
  }, _typeof(obj);
}
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) {
  try {
    var info = gen[key](arg);
    var value = info.value;
  } catch (error) {
    reject(error);
    return;
  }
  if (info.done) {
    resolve(value);
  } else {
    Promise.resolve(value).then(_next, _throw);
  }
}
function _asyncToGenerator(fn) {
  return function () {
    var self = this,
      args = arguments;
    return new Promise(function (resolve, reject) {
      var gen = fn.apply(self, args);
      function _next(value) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value);
      }
      function _throw(err) {
        asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err);
      }
      _next(undefined);
    });
  };
}
function _defineProperty(obj, key, value) {
  key = _toPropertyKey(key);
  if (key in obj) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
  } else {
    obj[key] = value;
  }
  return obj;
}
function _slicedToArray(arr, i) {
  return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest();
}
function _arrayWithHoles(arr) {
  if (Array.isArray(arr)) return arr;
}
function _unsupportedIterableToArray(o, minLen) {
  if (!o) return;
  if (typeof o === "string") return _arrayLikeToArray(o, minLen);
  var n = Object.prototype.toString.call(o).slice(8, -1);
  if (n === "Object" && o.constructor) n = o.constructor.name;
  if (n === "Map" || n === "Set") return Array.from(o);
  if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen);
}
function _arrayLikeToArray(arr, len) {
  if (len == null || len > arr.length) len = arr.length;
  for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i];
  return arr2;
}
function _nonIterableRest() {
  throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}
function _toPrimitive(input, hint) {
  if (typeof input !== "object" || input === null) return input;
  var prim = input[Symbol.toPrimitive];
  if (prim !== undefined) {
    var res = prim.call(input, hint || "default");
    if (typeof res !== "object") return res;
    throw new TypeError("@@toPrimitive must return a primitive value.");
  }
  return (hint === "string" ? String : Number)(input);
}
function _toPropertyKey(arg) {
  var key = _toPrimitive(arg, "string");
  return typeof key === "symbol" ? key : String(key);
}

var creators_offset = new Date().getTimezoneOffset() / 60;
if (creators_offset * -1 >= 0) {
  creators_offset *= -1;
  creators_offset = "".concat((creators_offset + "").padStart(2, "0"), ":00");
  creators_offset = "+".concat(creators_offset);
} else {
  creators_offset = "".concat((creators_offset + "").padStart(2, "0"), ":00");
  creators_offset = "-".concat(creators_offset);
}
var getHourlessDate = function getHourlessDate(date_string) {
  var today = date_string ? new Date(date_string) : new Date();
  var year = today.getFullYear() + "",
    month = (today.getMonth() + 1 + "").padStart(2, "0"),
    day = (today.getDate() + "").padStart(2, "0");
  return "".concat(year, "-").concat(month, "-").concat(day, "T00:00:00.000Z");
};
var getDatelessHour = function getDatelessHour(date_string, military) {
  var time = addTimezoneInfo(date_string);
  if (military) return getLocaleTime(time).slice(11, 16);
  return formatAMPM(new Date(getLocaleTime(time)));
};
var getTime = function getTime(date) {
  var dateObj = new Date(date);
  var minutes = dateObj.getUTCHours().toString().padStart(2, "0");
  var seconds = dateObj.getUTCMinutes().toString().padStart(2, "0");
  return "".concat(minutes, ":").concat(seconds);
};
var addDays = function addDays(date, days) {
  var dateObj = new Date(date);
  dateObj.setUTCHours(0, 0, 0, 0);
  dateObj.setDate(dateObj.getDate() + days);
  return dateObj;
};
var addMinutes = function addMinutes(date, minutes) {
  return new Date(date.getTime() + minutes * 60000);
};
var startOfWeek = function startOfWeek(date) {
  var d = new Date(date);
  var day = d.getDay(),
    diff = d.getDate() - day;

  // diff is 0-indexed
  diff++;
  return new Date(d.setDate(diff));
};
var endOfWeek = function endOfWeek(date) {
  var dateObj = new Date(date);
  dateObj.setUTCHours(0, 0, 0, 0);
  var toAdd = 7 - dateObj.getDay(); // getDate is also 0-indexed
  return addDays(dateObj, toAdd);
};
var cloneObject = function cloneObject(object) {
  return JSON.parse(JSON.stringify(object));
};
var getLocaleTime = function getLocaleTime(dateString) {
  var _Date$toLocaleString$ = new Date(dateString).toLocaleString("en-GB").split(", "),
    _Date$toLocaleString$2 = _slicedToArray(_Date$toLocaleString$, 2),
    date = _Date$toLocaleString$2[0],
    hour = _Date$toLocaleString$2[1];
  date = date.split("/").reverse().join("-");
  return "".concat(date, "T").concat(hour, ".000Z");
};
var addTimezoneInfo = function addTimezoneInfo(ISOdate) {
  if (new Date(ISOdate).toISOString() !== ISOdate) return;
  return "".concat(ISOdate.slice(0, 19)).concat(creators_offset);
};
var isToday = function isToday(date) {
  if (!date) return;
  var newDate = date.value ? date.value : date;
  var today = getLocaleTime(new Date()).slice(0, 10);
  return newDate.slice(0, 10) === today;
};
var isBefore = function isBefore(date1, date2) {
  if (!date1 || !date2) return;
  return new Date(date1) < new Date(date2);
};
var isWeekend = function isWeekend(date) {
  if (!date) return;
  var day = new Date(date).getDay();
  return day === 6 || day === 0;
};
var formatAMPM = function formatAMPM(date) {
  var hours = date.getUTCHours();
  var result = "".concat(hours % 12 === 0 ? 12 : hours % 12, " ").concat(hours >= 12 ? "PM" : "AM");
  return result;
};
var getDistance = function getDistance(event) {
  var hourlySelection = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  var diffInMs = new Date(event.end) - new Date(event.start);
  var diffInHrs = Math.floor(diffInMs % 86400000 / 3600000);
  var diffMins = Math.round(diffInMs % 86400000 % 3600000 / 60000);
  var startDate = new Date(event.start);
  var endDate = new Date(event.end);
  var distance = diffMins + diffInHrs * (hourlySelection ? 10 : 60);
  return distance;
};
var getTopDistance = function getTopDistance(start) {
  var date = new Date(start);
  return date.getMinutes() + date.getHours() * 60;
};

var script = {
  components: {
    KalendarWeekView: function KalendarWeekView() {
      return import('./kalendar-weekview-f912fb52.js');
    }
  },
  props: {
    // this provided array will be kept in sync
    devices: {
      required: true,
      type: Array,
      validator: function validator(val) {
        return Array.isArray(val) || _typeof(val) === 'object';
      }
    },
    // this provided array will be kept in sync
    settings: {
      required: false,
      type: Array | Object
    },
    // use this to enable/disable stuff which
    // are supported by Kalendar itself
    configuration: {
      type: Object,
      required: false,
      validator: function validator(val) {
        return _typeof(val) === 'object';
      }
    }
  },
  data: function data() {
    var _this = this;
    return {
      showCalendar: true,
      showPopup: false,
      showModal: false,
      showCart: false,
      showConfirm: false,
      showBooking: false,
      activeItem: {},
      events: [],
      current_day: getHourlessDate(),
      default_options: {
        cell_height: 10,
        scrollToNow: false,
        hourlySelection: false,
        start_day: getHourlessDate(),
        view_type: 'week',
        style: 'material_design',
        now: new Date(),
        military_time: true,
        read_only: false,
        day_starts_at: 0,
        day_ends_at: 24,
        time_mode: 'relative',
        overlap: true,
        past_event_creation: true,
        column_minwidth: 200,
        animation_speed: 200,
        formatLeftHours: function formatLeftHours(date) {
          return getDatelessHour(date, _this.configuration.military_time);
        },
        formatDayTitle: function formatDayTitle(date) {
          var isoDate = new Date(date);
          var dayName = isoDate.toUTCString().slice(0, 3);
          var dayNumber = isoDate.getUTCDate();
          return [dayName, dayNumber];
        },
        formatWeekNavigator: function formatWeekNavigator(isoDate) {
          var startDate = startOfWeek(isoDate);
          var endDate = endOfWeek(isoDate);
          var startString = startDate.toUTCString().slice(5, 11);
          var endString = endDate.toUTCString().slice(5, 11);
          return "".concat(startString, " - ").concat(endString);
        },
        formatDayNavigator: function formatDayNavigator(isoDate) {
          var day = new Date(isoDate);
          return day.toUTCString().slice(5, 11);
        }
      },
      kalendar_events: null,
      new_appointment: {},
      scrollable: true
    };
  },
  computed: {
    kalendar_options: function kalendar_options() {
      var options = this.default_options;
      var provided_props = this.configuration;
      var conditions = {
        scrollToNow: function scrollToNow(val) {
          return typeof val === 'boolean';
        },
        hourlySelection: function hourlySelection(val) {
          return typeof val === 'boolean';
        },
        start_day: function start_day(val) {
          return !isNaN(Date.parse(val));
        },
        view_type: function view_type(val) {
          return ['week', 'day'].includes(val);
        },
        cell_height: function cell_height(val) {
          return !isNaN(val);
        },
        style: function style(val) {
          return ['material_design', 'flat_design'].includes(val);
        },
        military_time: function military_time(val) {
          return typeof val === 'boolean';
        },
        read_only: function read_only(val) {
          return typeof val === 'boolean';
        },
        day_starts_at: function day_starts_at(val) {
          return typeof val === 'number' && val >= 0 && val <= 24;
        },
        day_ends_at: function day_ends_at(val) {
          return typeof val === 'number' && val >= 0 && val <= 24;
        },
        hide_dates: function hide_dates(val) {
          return Array.isArray(val);
        },
        hide_days: function hide_days(val) {
          return Array.isArray(val) && !val.find(function (n) {
            return typeof n !== 'number';
          });
        },
        overlap: function overlap(val) {
          return typeof val === 'boolean';
        },
        past_event_creation: function past_event_creation(val) {
          return typeof val === 'boolean';
        },
        column_minwidth: function column_minwidth(val) {
          return typeof val === 'number';
        },
        animation_speed: function animation_speed(val) {
          return typeof val === 'number';
        }
      };
      for (var key in provided_props) {
        if (conditions.hasOwnProperty(key) && conditions[key](provided_props[key])) {
          options[key] = provided_props[key];
        }
      }
      return options;
    }
  },
  created: function created() {
    var _this2 = this;
    this.current_day = this.kalendar_options.start_day;
    this.loadEvents();
    if (!this.$kalendar) {
      Vue.prototype.$kalendar = {};
    }
    this.$kalendar.getEvents = function () {
      return _this2.kalendar_events;
    };
    this.$kalendar.updateEvents = function (payload) {
      return _this2.loadEvents();
    };
  },
  provide: function provide() {
    var _this3 = this;
    var provider = {};
    Object.defineProperty(provider, 'kalendar_options', {
      enumerable: true,
      get: function get() {
        return _this3.kalendar_options;
      }
    });
    Object.defineProperty(provider, 'kalendar_events', {
      enumerable: true,
      get: function get() {
        return _this3.kalendar_events;
      }
    });
    return provider;
  },
  methods: {
    getTime: getTime,
    changeDay: function changeDay(numDays) {
      var _this4 = this;
      this.current_day = addDays(this.current_day, numDays).toISOString();
      setTimeout(function () {
        return _this4.reloadEvents();
      });
    },
    addAppointment: function addAppointment(popup_info) {
      var payload = {
        data: {
          title: this.new_appointment.title,
          description: this.new_appointment.description
        },
        from: popup_info.start_time,
        to: popup_info.end_time
      };
      this.$kalendar.closePopups();
      this.clearFormData();
    },
    clearFormData: function clearFormData() {
      this.new_appointment = {
        description: null,
        title: null
      };
    },
    closePopups: function closePopups() {
      this.$kalendar.closePopups();
    },
    addToCart: function addToCart(activeItem) {
      var item = {};
      this.showCart = true;
      if (activeItem) {
        item.id = activeItem.id;
        item.device = activeItem.device;
        item.price = activeItem.price;
        item.duration_time = activeItem.duration_time;
        item.duration_hours = activeItem.duration_hours;
        item.subtotal = activeItem.subtotal;
        item.game = activeItem.game;
        item.products = activeItem.products;
      }
      // this.$refs.side_cart.showCart = true
      // this.$parent.showSide = false;
      this.hidePopup(false);
      var t = this;
      setTimeout(function () {
        t.$refs.side_cart.addToCart(item);
      }, 1000);
    },
    /**
     * Update event data
     */
    updateInfo: function updateInfo(activeItem) {
      this.showPopup = false;
      this.showPopup = true;
      return this;
    },
    log: function log(data) {
      this.$parent.log(data);
    },
    show_modal: function show_modal() {
      var item = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      this.showPopup = false;
      if (item) {
        if (item.id && item.status && item.status == 'active') this.setActiveItem(item);
        if (item.status && item.status == 'completed') this.show_event(item);
        if (item.status && item.status == 'paid') this.show_paid_event(item);
        if (!item.id) this.setNewItem(item);
      }
      this.showPopup = true;
    },
    show_event: function show_event() {
      var item = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      this.showModal = false;
      this.setEvent(item);
    },
    show_paid_event: function show_paid_event() {
      var item = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      this.setEvent(item);
      this.showModal = false;
      this.showBooking = true;
    },
    addTime: function addTime(time) {
      var minutes = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
      return addMinutes(new Date(time), minutes);
    },
    dateTime: function dateTime(date) {
      var d = new Date(date).toISOString();
      var datestring = d.slice(11, 16);
      return datestring;
    },
    dateText: function dateText(date) {
      var d = new Date(date).toISOString();
      var datestring = d.slice(0, 10);
      return datestring;
    },
    /** 
     * Set active item
     * 
     */
    setNewItem: function setNewItem(newEvenet) {
      if (newEvenet.ending_cell.value === newEvenet.starting_cell.value) {
        var d = this.addTime(newEvenet.ending_cell.value, 60);
        newEvenet.ending_cell.value = this.dateText(d) + 'T' + this.dateTime(d) + ':00.000Z';
      }
      this.activeItem = cloneObject(newEvenet);
      this.games = newEvenet.device ? newEvenet.device.games : [];
      this.activeItem.device_id = newEvenet.device ? newEvenet.device.id : 0;
      this.activeItem.start = newEvenet.starting_cell ? this.dateTime(newEvenet.starting_cell.value) : null;
      this.activeItem.start_time = newEvenet.starting_cell ? newEvenet.starting_cell.time : null;
      this.activeItem.end = newEvenet.ending_cell ? this.dateTime(newEvenet.ending_cell.value) : null;
      this.activeItem.end_time = newEvenet.ending_cell ? newEvenet.ending_cell.time : null;
      this.activeItem.date = newEvenet.starting_cell ? this.dateText(newEvenet.starting_cell.value) : null;
      this.activeItem.booking_type = 'single';
      this.showModal = true;
      return this;
    },
    /** 
     * Set active item
     * '
     */
    setActiveItem: function setActiveItem(props) {
      this.activeItem = cloneObject(props);
      this.games = props.device ? props.device.games : [];
      this.activeItem.startStr = props.start;
      this.activeItem.start = props.starting_cell ? this.dateTime(props.starting_cell.value) : null;
      this.activeItem.start_time = props.starting_cell ? props.starting_cell.time : null;
      this.activeItem.end = props.ending_cell ? this.dateTime(props.ending_cell.value) : null;
      this.activeItem.end_time = props.ending_cell ? props.ending_cell.time : null;
      this.activeItem.date = props.starting_cell ? this.dateText(props.starting_cell.value) : null;
      this.activeItem.subtotal = this.subtotal();
      this.showModal = true;
      return this;
    },
    /** 
     * Set active item
     * '
     */
    setEvent: function setEvent(props) {
      this.activeItem = cloneObject(props);
      this.activeItem.startStr = props.start;
      this.activeItem.subtotal = this.subtotal();
      this.showModal = true;
      return this;
    },
    /**
     * Update event data
     */
    storeInfo: function storeInfo(activeItem) {
      this.submit('Event.create');
    },
    /**
     * Update event data
     */
    submit: function submit(type) {
      var _this5 = this;
      var request_type = this.activeItem.id ? 'update' : 'create';
      var params = new URLSearchParams([]);
      this.activeItem.start_time = this.current_day + ' ' + this.activeItem.start;
      this.activeItem.end_time = this.current_day + ' ' + this.activeItem.end;
      params.append('type', type);
      params.append('params[event]', JSON.stringify(this.activeItem));
      this.handleRequest(params, '/api/' + request_type).then(function (data) {
        _this5.hidePopup();
      });
    },
    subtotal: function subtotal() {
      var price = this.activeItem.device_cost;
      return (Number(price) * Number(this.activeItem.duration_hours)).toFixed(2);
    },
    hidePopup: function hidePopup() {
      var reload = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;
      this.showBooking = false;
      this.showModal = false;
      if (reload) {
        this.reloadEvents();
      }
    },
    reloadEvents: function reloadEvents() {
      var _this6 = this;
      return _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
        return _regeneratorRuntime().wrap(function _callee$(_context) {
          while (1) switch (_context.prev = _context.next) {
            case 0:
              _this6.showCalendar = false;
              _context.next = 3;
              return _this6.loadEvents().then(function (response) {
                _this6.showCalendar = true;
              });
            case 3:
              return _context.abrupt("return", _context.sent);
            case 4:
            case "end":
              return _context.stop();
          }
        }, _callee);
      }))();
    },
    /**
     * Load events 
     */
    loadEvents: function loadEvents() {
      var _this7 = this;
      return _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2() {
        return _regeneratorRuntime().wrap(function _callee2$(_context2) {
          while (1) switch (_context2.prev = _context2.next) {
            case 0:
              _context2.next = 2;
              return _this7.handleGetRequest('/api/calendar_events?start=' + _this7.current_day + '&end=' + addDays(_this7.current_day, 1).toISOString()).then(function (response) {
                _this7.kalendar_events = response;
                return _this7;
              });
            case 2:
              return _context2.abrupt("return", _context2.sent);
            case 3:
            case "end":
              return _context2.stop();
          }
        }, _callee2);
      }))();
    },
    handleGetRequest: function handleGetRequest(url) {
      var _this8 = this;
      return _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee3() {
        return _regeneratorRuntime().wrap(function _callee3$(_context3) {
          while (1) switch (_context3.prev = _context3.next) {
            case 0:
              _context3.next = 2;
              return _this8.$parent.handleGetRequest(url);
            case 2:
              return _context3.abrupt("return", _context3.sent);
            case 3:
            case "end":
              return _context3.stop();
          }
        }, _callee3);
      }))();
    },
    handleRequest: function handleRequest(params) {
      var _arguments = arguments,
        _this9 = this;
      return _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee4() {
        var url;
        return _regeneratorRuntime().wrap(function _callee4$(_context4) {
          while (1) switch (_context4.prev = _context4.next) {
            case 0:
              url = _arguments.length > 1 && _arguments[1] !== undefined ? _arguments[1] : '/';
              _context4.next = 3;
              return _this9.$parent.handleRequest(params, url);
            case 3:
              return _context4.abrupt("return", _context4.sent);
            case 4:
            case "end":
              return _context4.stop();
          }
        }, _callee4);
      }))();
    },
    __: function __(i) {
      return this.$parent.__(i);
    }
  }
};

function normalizeComponent(template, style, script, scopeId, isFunctionalTemplate, moduleIdentifier /* server only */, shadowMode, createInjector, createInjectorSSR, createInjectorShadow) {
    if (typeof shadowMode !== 'boolean') {
        createInjectorSSR = createInjector;
        createInjector = shadowMode;
        shadowMode = false;
    }
    // Vue.extend constructor export interop.
    const options = typeof script === 'function' ? script.options : script;
    // render functions
    if (template && template.render) {
        options.render = template.render;
        options.staticRenderFns = template.staticRenderFns;
        options._compiled = true;
        // functional template
        if (isFunctionalTemplate) {
            options.functional = true;
        }
    }
    // scopedId
    if (scopeId) {
        options._scopeId = scopeId;
    }
    let hook;
    if (moduleIdentifier) {
        // server build
        hook = function (context) {
            // 2.3 injection
            context =
                context || // cached call
                    (this.$vnode && this.$vnode.ssrContext) || // stateful
                    (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext); // functional
            // 2.2 with runInNewContext: true
            if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
                context = __VUE_SSR_CONTEXT__;
            }
            // inject component styles
            if (style) {
                style.call(this, createInjectorSSR(context));
            }
            // register component module identifier for async chunk inference
            if (context && context._registeredComponents) {
                context._registeredComponents.add(moduleIdentifier);
            }
        };
        // used by ssr in case component is cached and beforeCreate
        // never gets called
        options._ssrRegister = hook;
    }
    else if (style) {
        hook = shadowMode
            ? function (context) {
                style.call(this, createInjectorShadow(context, this.$root.$options.shadowRoot));
            }
            : function (context) {
                style.call(this, createInjector(context));
            };
    }
    if (hook) {
        if (options.functional) {
            // register for functional component in vue file
            const originalRender = options.render;
            options.render = function renderWithStyleInjection(h, context) {
                hook.call(context);
                return originalRender(h, context);
            };
        }
        else {
            // inject component registration as beforeCreate hook
            const existing = options.beforeCreate;
            options.beforeCreate = existing ? [].concat(existing, hook) : [hook];
        }
    }
    return script;
}

const isOldIE = typeof navigator !== 'undefined' &&
    /msie [6-9]\\b/.test(navigator.userAgent.toLowerCase());
function createInjector(context) {
    return (id, style) => addStyle(id, style);
}
let HEAD;
const styles = {};
function addStyle(id, css) {
    const group = isOldIE ? css.media || 'default' : id;
    const style = styles[group] || (styles[group] = { ids: new Set(), styles: [] });
    if (!style.ids.has(id)) {
        style.ids.add(id);
        let code = css.source;
        if (css.map) {
            // https://developer.chrome.com/devtools/docs/javascript-debugging
            // this makes source maps inside style tags work properly in Chrome
            code += '\n/*# sourceURL=' + css.map.sources[0] + ' */';
            // http://stackoverflow.com/a/26603875
            code +=
                '\n/*# sourceMappingURL=data:application/json;base64,' +
                    btoa(unescape(encodeURIComponent(JSON.stringify(css.map)))) +
                    ' */';
        }
        if (!style.element) {
            style.element = document.createElement('style');
            style.element.type = 'text/css';
            if (css.media)
                style.element.setAttribute('media', css.media);
            if (HEAD === undefined) {
                HEAD = document.head || document.getElementsByTagName('head')[0];
            }
            HEAD.appendChild(style.element);
        }
        if ('styleSheet' in style.element) {
            style.styles.push(code);
            style.element.styleSheet.cssText = style.styles
                .filter(Boolean)
                .join('\n');
        }
        else {
            const index = style.ids.size - 1;
            const textNode = document.createTextNode(code);
            const nodes = style.element.childNodes;
            if (nodes[index])
                style.element.removeChild(nodes[index]);
            if (nodes.length)
                style.element.insertBefore(textNode, nodes[index]);
            else
                style.element.appendChild(textNode);
        }
    }
}

/* script */
var __vue_script__ = script;

/* template */
var __vue_render__ = function __vue_render__() {
  var _vm = this;
  var _h = _vm.$createElement;
  var _c = _vm._self._c || _h;
  return _c('div', {
    staticClass: "kalendar-wrapper px-2",
    class: {
      'no-scroll': !_vm.scrollable,
      gstyle: _vm.kalendar_options.style === 'material_design',
      'day-view': _vm.kalendar_options.view_type === 'day'
    },
    attrs: {
      "id": "calendar_wrapper"
    },
    on: {
      "touchstart": function touchstart($event) {
        _vm.scrollable = false;
      },
      "touchend": function touchend($event) {
        _vm.scrollable = true;
      }
    }
  }, [_c('div', {
    staticClass: "week-navigator",
    staticStyle: {
      "direction": "ltr"
    }
  }, [_vm.kalendar_options.view_type === 'week' ? _c('div', {
    staticClass: "nav-wrapper"
  }, [_c('button', {
    staticClass: "week-navigator-button",
    on: {
      "click": function click($event) {
        return _vm.changeDay(-7);
      }
    }
  }, [_c('svg', {
    staticClass: "css-i6dzq1",
    staticStyle: {
      "transform": "rotate(180deg)"
    },
    attrs: {
      "viewBox": "0 0 24 24",
      "width": "24",
      "height": "24",
      "stroke": "currentColor",
      "stroke-width": "2",
      "fill": "none",
      "stroke-linecap": "round",
      "stroke-linejoin": "round"
    }
  }, [_c('polyline', {
    attrs: {
      "points": "9 18 15 12 9 6"
    }
  })])]), _vm._v(" "), _c('div', [_c('span', [_vm._v(_vm._s(_vm.kalendar_options.formatWeekNavigator(_vm.current_day)))])]), _vm._v(" "), _c('button', {
    staticClass: "week-navigator-button",
    on: {
      "click": function click($event) {
        return _vm.changeDay(7);
      }
    }
  }, [_c('svg', {
    staticClass: "css-i6dzq1",
    attrs: {
      "viewBox": "0 0 24 24",
      "width": "24",
      "height": "24",
      "stroke": "currentColor",
      "stroke-width": "2",
      "fill": "none",
      "stroke-linecap": "round",
      "stroke-linejoin": "round"
    }
  }, [_c('polyline', {
    attrs: {
      "points": "9 18 15 12 9 6"
    }
  })])])]) : _vm._e(), _vm._v(" "), _vm.kalendar_options.view_type === 'day' ? _c('div', {
    staticClass: "nav-wrapper"
  }, [_c('button', {
    staticClass: "week-navigator-button",
    on: {
      "click": function click($event) {
        return _vm.changeDay(-1);
      }
    }
  }, [_c('svg', {
    staticClass: "css-i6dzq1",
    staticStyle: {
      "transform": "rotate(180deg)"
    },
    attrs: {
      "viewBox": "0 0 24 24",
      "width": "24",
      "height": "24",
      "stroke": "currentColor",
      "stroke-width": "2",
      "fill": "none",
      "stroke-linecap": "round",
      "stroke-linejoin": "round"
    }
  }, [_c('polyline', {
    attrs: {
      "points": "9 18 15 12 9 6"
    }
  })])]), _vm._v(" "), _c('div', [_c('span', [_vm._v(_vm._s(_vm.kalendar_options.formatDayNavigator(_vm.current_day)))])]), _vm._v(" "), _c('button', {
    staticClass: "week-navigator-button",
    on: {
      "click": function click($event) {
        return _vm.changeDay(1);
      }
    }
  }, [_c('svg', {
    staticClass: "css-i6dzq1",
    attrs: {
      "viewBox": "0 0 24 24",
      "width": "24",
      "height": "24",
      "stroke": "currentColor",
      "stroke-width": "2",
      "fill": "none",
      "stroke-linecap": "round",
      "stroke-linejoin": "round"
    }
  }, [_c('polyline', {
    attrs: {
      "points": "9 18 15 12 9 6"
    }
  })])])]) : _vm._e()]), _vm._v(" "), _vm.showCalendar ? _c('kalendar-week-view', {
    key: _vm.current_day,
    attrs: {
      "events": _vm.kalendar_events,
      "current_day": _vm.current_day,
      "devices": _vm.devices
    }
  }) : _vm._e(), _vm._v(" "), _c('portal', {
    staticClass: "slotable",
    attrs: {
      "to": "event-details"
    },
    scopedSlots: _vm._u([{
      key: "default",
      fn: function fn(information) {
        return _c('div', {}, [_vm._t("created-card", function () {
          return [_c('div', {
            staticClass: "absolute top-4 right-2 flex gap gap-2 font-semibold text-xs"
          }, [_c('span', {
            domProps: {
              "textContent": _vm._s(information.start_time)
            }
          }), _vm._v(" "), _c('span', {
            domProps: {
              "textContent": _vm._s(information.end_time)
            }
          })]), _vm._v(" "), _c('div', [_c('span', {
            staticClass: "w-full block pb-2 text-left",
            staticStyle: {
              "direction": "ltr"
            }
          }, [information.game ? _c('img', {
            staticClass: "rounded-full w-8 h-8 mb-2",
            attrs: {
              "src": information.game.picture
            }
          }) : _vm._e(), _vm._v(" "), _c('span', {
            staticClass: "font-xxs font-semibold text-left w-full",
            domProps: {
              "textContent": _vm._s(information.title)
            }
          })])])];
        }, {
          "event_information": information
        })], 2);
      }
    }], null, true)
  }), _vm._v(" "), _c('portal', {
    staticClass: "slotable",
    attrs: {
      "to": "event-popup-form"
    },
    scopedSlots: _vm._u([{
      key: "default",
      fn: function fn(information) {
        return _c('div', {
          staticClass: "created-event"
        }, [_vm._t("created-card", function () {
          return [_c('h4', {
            staticStyle: {
              "margin-bottom": "5px"
            }
          }, [_vm._v(_vm._s(information.title))])];
        }, {
          "event_information": information
        })], 2);
      }
    }], null, true)
  }), _vm._v(" "), _vm.showPopup ? _c('div', [_vm.showModal && _vm.activeItem && !_vm.activeItem.id ? _c('div', {
    staticClass: "fixed top-0 left-0 w-full h-full",
    staticStyle: {
      "z-index": "99"
    }
  }, [_c('div', {
    staticClass: "absolute top-0 left-0 w-full h-full",
    staticStyle: {
      "background": "rgba(0,0,0,.6)"
    },
    on: {
      "click": _vm.hidePopup
    }
  }), _vm._v(" "), _c('div', {
    staticClass: "left-0 right-0 fixed mx-auto w-full",
    staticStyle: {
      "max-width": "600px",
      "z-index": "99"
    }
  }, [_c('div', {
    staticClass: "relative h-full"
  }, [_c('calendar_new_item', {
    attrs: {
      "modal": _vm.activeItem,
      "games": _vm.activeItem.device ? _vm.activeItem.device.games : []
    }
  })], 1)])]) : _vm._e(), _vm._v(" "), _vm.showModal && _vm.activeItem && _vm.activeItem.id ? _c('div', {
    staticClass: "fixed top-0 left-0 w-full h-full",
    staticStyle: {
      "z-index": "99"
    }
  }, [_c('div', {
    staticClass: "absolute top-0 left-0 w-full h-full",
    staticStyle: {
      "background": "rgba(0,0,0,.6)"
    },
    on: {
      "click": _vm.hidePopup
    }
  }), _vm._v(" "), _c('div', {
    staticClass: "left-0 right-0 fixed mx-auto w-full",
    staticStyle: {
      "max-width": "600px",
      "z-index": "99"
    }
  }, [_c('div', {
    staticClass: "relative h-full"
  }, [_vm.showConfirm ? _c('div', {
    staticClass: "top-20 relative mx-auto w-full bg-white p-6 rounded-lg",
    staticStyle: {
      "max-width": "600px",
      "z-index": "99"
    }
  }, [_c('div', {
    staticClass: "bg-blue-200 rounded-md py-2 px-4",
    attrs: {
      "role": "alert"
    }
  }, [_c('strong', {
    domProps: {
      "textContent": _vm._s(_vm.__('confirm'))
    }
  }), _vm._v(" "), _c('span', {
    domProps: {
      "textContent": _vm._s(_vm.__('confirm_complete_booking'))
    }
  }), _vm._v(" "), _c('button', {
    staticClass: "btn-close",
    attrs: {
      "type": "button",
      "data-bs-dismiss": "alert",
      "aria-label": "Close"
    },
    on: {
      "click": function click($event) {
        _vm.showConfirm = false;
      }
    }
  })]), _vm._v(" "), _c('div', {
    staticClass: "my-2 cursor-pointer w-full text-white font-semibold py-2 border-b border-gray-200"
  }, [_c('label', {
    staticClass: "w-32 mx-auto py-2 rounded-lg bg-gradient-primary block text-center cursor-pointer",
    domProps: {
      "textContent": _vm._s(_vm.__('confirm'))
    },
    on: {
      "click": function click($event) {
        _vm.activeItem.status = 'completed';
        _vm.submit('Event.update');
      }
    }
  })])]) : _vm._e(), _vm._v(" "), _c('calendar_active_item', {
    attrs: {
      "modal": _vm.activeItem
    }
  })], 1)])]) : _vm._e(), _vm._v(" "), _vm.showBooking && _vm.activeItem ? _c('div', {
    staticClass: "fixed top-0 left-0 w-full h-full",
    staticStyle: {
      "z-index": "99"
    }
  }, [_c('div', {
    staticClass: "absolute top-0 left-0 w-full h-full",
    staticStyle: {
      "background": "rgba(0,0,0,.6)"
    },
    on: {
      "click": _vm.hidePopup
    }
  }), _vm._v(" "), _c('div', {
    staticClass: "left-0 right-0 fixed mx-auto w-full",
    staticStyle: {
      "max-width": "600px",
      "z-index": "99"
    }
  }, [_c('div', {
    staticClass: "relative h-full"
  }, [_c('calendar_modal', {
    attrs: {
      "modal": _vm.activeItem
    }
  })], 1)])]) : _vm._e()]) : _vm._e(), _vm._v(" "), _vm.showCart ? _c('div', {
    staticClass: "w-full h-full fixed top-0 left-0",
    staticStyle: {
      "z-index": "999"
    }
  }, [_vm.showCart ? _c('div', {
    staticClass: "fixed h-full w-full top-0 left-0 bg-gray-800",
    staticStyle: {
      "opacity": ".6",
      "z-index": "9"
    },
    on: {
      "click": function click($event) {
        _vm.showCart = false;
        _vm.hidePopup;
      }
    }
  }) : _vm._e(), _vm._v(" "), _vm.showCart ? _c('side_cart', {
    ref: "side_cart",
    attrs: {
      "setting": _vm.settings,
      "currency": _vm.settings.currency
    }
  }) : _vm._e()], 1) : _vm._e()], 1);
};
var __vue_staticRenderFns__ = [];

/* style */
var __vue_inject_styles__ = function __vue_inject_styles__(inject) {
  if (!inject) return;
  inject("data-v-0cafb161_0", {
    source: "*{box-sizing:border-box}.kalendar-wrapper{font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,Helvetica,Arial,sans-serif,\"Apple Color Emoji\",\"Segoe UI Emoji\",\"Segoe UI Symbol\";min-height:1440px;--main-color:#ec4d3d;--weekend-color:#f7f7f7;--current-day-color:#fef4f4;--table-cell-border-color:#e5e5e5;--odd-cell-border-color:#e5e5e5;--hour-row-color:inherit;--dark:#212121;--lightg:#9e9e9e;--card-bgcolor:#4285f4;--card-color:white;--max-hours:10;--previous-events:#c6dafc;--previous-text-color:#727d8f}.kalendar-wrapper.gstyle{--hour-row-color:#212121;--main-color:#4285f4;--weekend-color:transparent;--current-day-color:transparent;--table-cell-border-color:#e0e0e0;--odd-cell-border-color:transparent;font-family:\"Google Sans\",Roboto,-apple-system,BlinkMacSystemFont,\"Segoe UI\",Arial,sans-serif}.kalendar-wrapper.gstyle .week-navigator{background:#fff;border-bottom:none;padding:20px;color:rgba(0,0,0,.54)}.kalendar-wrapper.gstyle .week-navigator button{color:rgba(0,0,0,.54)}.kalendar-wrapper.gstyle .created-event,.kalendar-wrapper.gstyle .creating-event{background-color:var(--card-bgcolor);color:var(--card-color);text-shadow:none;border-left:none;border-radius:2px;opacity:1;border-bottom:solid 1px rgba(0,0,0,.03)}.kalendar-wrapper.gstyle .created-event>*,.kalendar-wrapper.gstyle .creating-event>*{text-shadow:none}.kalendar-wrapper.gstyle .is-past .created-event,.kalendar-wrapper.gstyle .is-past .creating-event{background-color:var(--previous-events);color:var(--previous-text-color)}.kalendar-wrapper.gstyle .created-event{width:96%}.kalendar-wrapper.gstyle .created-event .time{right:2px}.kalendar-wrapper.gstyle .sticky-top .days{margin-left:0;padding-left:55px}.kalendar-wrapper.gstyle .all-day{display:none}.kalendar-wrapper.gstyle ul.building-blocks.day-1 li.is-an-hour::before{content:\"\";position:absolute;bottom:-1px;left:-10px;width:10px;height:1px;background-color:var(--table-cell-border-color)}.kalendar-wrapper.gstyle .hours,.kalendar-wrapper.gstyle ul.building-blocks li{border-right:solid 1px var(--table-cell-border-color)}.kalendar-wrapper.gstyle .hours li{font-size:80%}.kalendar-wrapper.gstyle .hour-indicator-line>span.line{height:2px;background-color:#db4437}.kalendar-wrapper.gstyle .hour-indicator-line>span.line:before{content:\"\";width:12px;height:12px;display:block;background-color:#db4437;position:absolute;top:-1px;left:0;border-radius:100%}.kalendar-wrapper.gstyle .days{border-top:solid 1px var(--table-cell-border-color);position:relative}.kalendar-wrapper.gstyle .days:before{content:\"\";position:absolute;height:1px;width:55px;left:0;bottom:0;background-color:var(--table-cell-border-color)}.kalendar-wrapper.gstyle .day-indicator{display:flex;flex-direction:column;align-items:center;color:var(--dark);font-size:13px;padding-left:0;border-right:solid 1px var(--table-cell-border-color)}.kalendar-wrapper.gstyle .day-indicator>div{display:flex;flex-direction:column;align-items:center}.kalendar-wrapper.gstyle .day-indicator.is-before{color:#757575}.kalendar-wrapper.gstyle .day-indicator .number-date{margin-left:0;margin-right:0;order:2;font-size:16px;font-weight:500;width:28px;height:28px;border-radius:100%;align-items:center;justify-content:center;display:flex;margin-top:4px}.kalendar-wrapper.gstyle .day-indicator.today{border-bottom-color:var(--table-cell-border-color)}.kalendar-wrapper.gstyle .day-indicator.today:after{display:none}.kalendar-wrapper.gstyle .day-indicator.today .number-date{background-color:var(--main-color);color:#fff}.kalendar-wrapper.gstyle .day-indicator .letters-date{margin-left:0;margin-right:0;font-weight:500;text-transform:uppercase;font-size:11px}.kalendar-wrapper.gstyle .day-indicator:first-child{position:relative}.kalendar-wrapper.gstyle .day-indicator:first-child::before{content:\"\";position:absolute;left:-1px;top:0;width:1px;height:100%;background-color:var(--table-cell-border-color)}.kalendar-wrapper.gstyle .creating-event,.kalendar-wrapper.gstyle .popup-wrapper{box-shadow:0 6px 10px 0 rgba(0,0,0,.14),0 1px 18px 0 rgba(0,0,0,.12),0 3px 5px -1px rgba(0,0,0,.2);transition:opacity .1s linear}.kalendar-wrapper.non-desktop .building-blocks{pointer-events:none}.kalendar-wrapper.day-view .day-indicator{align-items:flex-start;text-align:center;padding-left:10px}.created-event,.creating-event{padding:4px 6px;cursor:default;word-break:break-word;height:100%;width:100%;font-size:14px}.created-event h4,.creating-event h4{font-weight:400}.creating-event{background-color:#34aadc;opacity:.9}.creating-event>*{text-shadow:0 0 7px rgba(0,0,0,.25)}.created-event{background-color:#bfecff;opacity:.74;border-left:solid 3px #34aadc;color:#1f6570}.week-navigator{display:flex;align-items:center;background:linear-gradient(#fdfdfd,#f9f9f9);border-bottom:solid 1px #ec4d3d;padding:10px 20px}.week-navigator .nav-wrapper{display:flex;align-items:center;justify-content:space-between;font-size:22px;width:25ch;max-width:30ch;margin:0 auto}.week-navigator .nav-wrapper span{white-space:nowrap}.week-navigator button{background:0 0;border:none;padding:0;display:inline-flex;margin:0 10px;color:#ec4d3d;align-items:center;font-size:14px;padding-bottom:5px}.kalendar-wrapper{background-color:#fff;min-width:300px}.no-scroll{overflow-y:hidden;max-height:100%}.hour-indicator-line{position:absolute;z-index:2;width:100%;height:10px;display:flex;align-items:center;pointer-events:none;user-select:none}.hour-indicator-line>span.line{background-color:var(--main-color);height:1px;display:block;flex:1}.hour-indicator-line>span.time-value{font-size:14px;width:48px;color:var(--main-color);font-weight:600;background-color:#fff}.hour-indicator-tooltip{position:absolute;z-index:0;background-color:var(--main-color);width:10px;height:10px;display:block;border-radius:100%;pointer-events:none;user-select:none}ul.kalendar-day li.kalendar-cell:last-child{display:none}.week-navigator-button{outline:0}.week-navigator-button:active svg,.week-navigator-button:hover svg{stroke:var(--main-color)}",
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

var __vue_component__ = /*#__PURE__*/normalizeComponent({
  render: __vue_render__,
  staticRenderFns: __vue_staticRenderFns__
}, __vue_inject_styles__, __vue_script__, __vue_scope_id__, __vue_is_functional_template__, __vue_module_identifier__, false, createInjector, undefined, undefined);

/* eslint-disable import/prefer-default-export */

var components = /*#__PURE__*/Object.freeze({
  __proto__: null,
  Kalendar: __vue_component__
});

// install function executed by Vue.use()
var install = function installKalendarVue(Vue) {
  if (install.installed) return;
  install.installed = true;
  Object.entries(components).forEach(function (_ref) {
    var _ref2 = _slicedToArray(_ref, 2),
      componentName = _ref2[0],
      component = _ref2[1];
    Vue.component(componentName, component);
  });
  Vue.prototype.$kalendar = {};
};

// Create module definition for Vue.use()
var plugin = {
  install: install
};

// To auto-install when vue is found
// eslint-disable-next-line no-redeclare
/* global window, global */
var GlobalVue = null;
if (typeof window !== "undefined") {
  GlobalVue = window.Vue;
} else if (typeof global !== "undefined") {
  GlobalVue = global.Vue;
}
if (GlobalVue) {
  GlobalVue.use(plugin);
}

export { __vue_component__ as _, isToday as a, _objectSpread2 as b, cloneObject as c, normalizeComponent as d, createInjector as e, _typeof as f, getDistance as g, getTopDistance as h, isWeekend as i, getLocaleTime as j, isBefore as k, getHourlessDate as l, addTimezoneInfo as m, _defineProperty as n, plugin as p };
