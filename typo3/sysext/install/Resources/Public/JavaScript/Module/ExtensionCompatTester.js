/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
var __extends=this&&this.__extends||function(){var e=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(e,t){e.__proto__=t}||function(e,t){for(var n in t)t.hasOwnProperty(n)&&(e[n]=t[n])};return function(t,n){function o(){this.constructor=t}e(t,n),t.prototype=null===n?Object.create(n):(o.prototype=n.prototype,new o)}}();define(["require","exports","./AbstractInteractableModule","jquery","../Router","../Renderable/ProgressBar","../Renderable/InfoBox","../Renderable/Severity","TYPO3/CMS/Backend/Notification","bootstrap"],function(e,t,n,o,r,a,i,s,l){"use strict";return new(function(e){function t(){var t=null!==e&&e.apply(this,arguments)||this;return t.selectorCheckTrigger=".t3js-extensionCompatTester-check",t.selectorUninstallTrigger=".t3js-extensionCompatTester-uninstall",t.selectorOutputContainer=".t3js-extensionCompatTester-output",t}return __extends(t,e),t.prototype.initialize=function(e){var t=this;this.currentModal=e,this.getLoadedExtensionList(),e.on("click",this.selectorCheckTrigger,function(n){e.find(t.selectorUninstallTrigger).hide(),e.find(t.selectorOutputContainer).empty(),t.getLoadedExtensionList()}),e.on("click",this.selectorUninstallTrigger,function(e){t.uninstallExtension(o(e.target).data("extension"))})},t.prototype.getLoadedExtensionList=function(){var e=this;this.findInModal(this.selectorCheckTrigger).prop("disabled",!0),this.findInModal(".modal-loading").hide();var t=this.getModalBody(),n=this.findInModal(this.selectorOutputContainer),c=a.render(s.loading,"Loading...","");n.append(c),o.ajax({url:r.getUrl("extensionCompatTesterLoadedExtensionList"),cache:!1,success:function(n){t.empty().append(n.html);var r,c,d=e.findInModal(e.selectorOutputContainer),p=a.render(s.loading,"Loading...","");if(d.append(p),!0===n.success&&Array.isArray(n.extensions)){o.when((c=[],n.extensions.forEach(function(t){c.push(e.loadExtLocalconf(t))}),o.when.apply(o,c).done(function(){var e=i.render(s.ok,"ext_localconf.php of all loaded extensions successfully loaded","");d.append(e)})),(r=[],n.extensions.forEach(function(t){r.push(e.loadExtTables(t))}),o.when.apply(o,r).done(function(){var e=i.render(s.ok,"ext_tables.php of all loaded extensions successfully loaded","");d.append(e)}))).fail(function(n){var o=i.render(s.error,"Loading "+n.scope+' of extension "'+n.extension+'" failed');d.append(o),t.find(e.selectorUninstallTrigger).text('Unload extension "'+n.extension+'"').attr("data-extension",n.extension).show()}).always(function(){d.find(".alert-loading").remove(),e.findInModal(e.selectorCheckTrigger).prop("disabled",!1)})}else l.error("Something went wrong")},error:function(e){r.handleAjaxError(e,t)}})},t.prototype.loadExtLocalconf=function(e){var t=this.getModuleContent().data("extension-compat-tester-load-ext_localconf-token");return o.ajax({url:r.getUrl(),method:"POST",cache:!1,data:{install:{action:"extensionCompatTesterLoadExtLocalconf",token:t,extension:e}}}).promise().then(null,function(){throw{scope:"ext_localconf.php",extension:e}})},t.prototype.loadExtTables=function(e){var t=this.getModuleContent().data("extension-compat-tester-load-ext_tables-token");return o.ajax({url:r.getUrl(),method:"POST",cache:!1,data:{install:{action:"extensionCompatTesterLoadExtTables",token:t,extension:e}}}).promise().then(null,function(){throw{scope:"ext_tables.php",extension:e}})},t.prototype.uninstallExtension=function(e){var t=this,n=this.getModuleContent().data("extension-compat-tester-uninstall-extension-token"),c=this.getModalBody(),d=o(this.selectorOutputContainer),p=a.render(s.loading,"Loading...","");d.append(p),o.ajax({url:r.getUrl(),cache:!1,method:"POST",data:{install:{action:"extensionCompatTesterUninstallExtension",token:n,extension:e}},success:function(e){e.success?(Array.isArray(e.status)&&e.status.forEach(function(e){var n=i.render(e.severity,e.title,e.message);c.find(t.selectorOutputContainer).empty().append(n)}),o(t.selectorUninstallTrigger).hide(),t.getLoadedExtensionList()):l.error("Something went wrong")},error:function(e){r.handleAjaxError(e,c)}})},t}(n.AbstractInteractableModule))});