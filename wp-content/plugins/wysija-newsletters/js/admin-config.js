jQuery(function(f){var h=f("#smtp-login").val();f(".hidechoice").hide();f(".choice-sending-method-"+f('input[name="wysija[config][sending_method]"]:checked').val()).show();f('input[name="wysija[config][sending_method]"]').change(function(){f(".hidechoice").hide();f(".choice-sending-method-"+this.value).show();g()});f("#sending-emails-each").change(function(){a()});f("#linksendingmethod").click(function(){f("#tabs").tabs("select",f(this).attr("href"))});f("#mainmenu li a").click(function(){f("#redirecttab").val(f(this).attr("href"))});f('input[name="wysija[config][confirm_dbleoptin]"]').change(i);f("#confirm_dbleoptin-1").click(function(){return confirm(wysijatrans.doubleoptinon)});f("#confirm_dbleoptin-0").click(function(){return confirm(wysijatrans.doubleoptinoff)});f('input[name="wysija[config][sending_emails_site_method]"]').change(function(){if(f('input[name="wysija[config][sending_emails_site_method]"]:checked').val()=="sendmail"){f("#p-sending-emails-site-method-sendmail-path").show()}else{f("#p-sending-emails-site-method-sendmail-path").hide()}});f('input[name="wysija[config][sending_emails_site_method]"]').change();f("#smtp-host").keyup(function(){if(this.value=="smtp.gmail.com"){if(h==""){f("#smtp-port").val("465");f("#smtp-secure").val("ssl");f("#smtp-login").val("your_username@gmail.com")}}else{if(h==""){f("#smtp-port").val("25");f("#smtp-secure").val("0");f("#smtp-login").val("")}}if(h==""){f("#smtp-secure").change()}});function i(){if(parseInt(f('input[name="wysija[config][confirm_dbleoptin]"]:checked').attr("value"))===1){f(".confirmemail").fadeIn()}else{f(".confirmemail").fadeOut()}}function a(){if(f.inArray(f("#sending-emails-each").val(),["one_min","two_min","five_min","ten_min"])!==-1){f(".choice-under15").show()}else{f(".choice-under15").hide()}}function g(){if(f('input[name="wysija[config][sending_method]"]:checked').val()=="gmail"){f("#sending-emails-number").val("20");f('select[name="wysija[config][sending_emails_each]"]').val("hourly");f("#sending-emails-number").attr("readonly","readonly");f('select[name="wysija[config][sending_emails_each]"]').attr("disabled","disabled")}else{if(f("#sending-emails-number").val()=="200"||f("#sending-emails-number").val()=="20"){f("#sending-emails-number").val("200");f('select[name="wysija[config][sending_emails_each]"]').removeAttr("disabled");f("#sending-emails-number").removeAttr("readonly")}}}function b(){wysijaAJAX.task="send_test_mail";wysijaAJAX.data=f("form").serializeArray();wysijaAJAX.popTitle=wysijatrans.testemail;wysijaAJAX.dataType="json";f.WYSIJA_SEND();return false}f("#send-test-mail-phpmail").click(function(){f("#sending-emails-site-method-phpmail").attr("checked","checked");b();return false});f("#send-test-mail-sendmail").click(function(){f("#sending-emails-site-method-sendmail").attr("checked","checked");b();return false});f("#send-test-mail-smtp").click(function(){b();return false});function c(){wysijaAJAX.task="bounce_connect";wysijaAJAX.data=f("form").serializeArray();wysijaAJAX.popTitle=wysijatrans.bounceconnect;wysijaAJAX.dataType="json";wysijaAJAXcallback.onSuccess=function(l){var k="";if(l.result.result){k='<a class="bounce-submit button-secondary" href2="admin.php?page=wysija_campaigns&action=test">'+wysijatrans.processbounce+"</a>"}if(displaychange){f(".allmsgs.ui-dialog-content.ui-widget-content").append(k)}else{f("#bounce-connector").after(k)}return true};f.WYSIJA_SEND();return false}f("#bounce-connector").click(c);function e(){wysijaAJAX.task="bounce_process";wysijaAJAX.data=f("form").serializeArray();wysijaAJAX.popTitle=wysijatrans.processbounceT;wysijaAJAX.dataType="html";f(".wysija-msg.ajax .allmsgs").dialog();f.WYSIJA_SEND();return false}f(".bounce-submit").live("click",function(){f(".allmsgs").dialog("close");tb_show(wysijatrans.processbounceT,f(this).attr("href2")+"&KeepThis=true&TB_iframe=true&height=400&width=600",null);tb_showIframe();return false});f(".forwardto").change(function(){if(f(this).attr("checked")){f("#"+f(this).attr("id")+"_input").show()}else{f("#"+f(this).attr("id")+"_input").hide()}});f.each(f(".hideifnovalue"),function(){if(f(this).find("input").val()==""){f(this).hide()}});f("#wysija-settings").submit(function(){var k=false;f(".bounce-forward-email").each(function(){var l=trim(f(this).val());if(l!==""&&l==f("#bounce_email").val()){f('#wysija-tabs a[href="#bounce"]').trigger("click");f('#wysija-innertabs a[href="#actions"]').trigger("click");f(this).css("border","1px solid #CC0000");f("#bounce-msg-error").addClass("error");f("#bounce-msg-error").html(wysijatrans.errorbounceforward);k=true}});if(k){return false}f('select[name="wysija[config][sending_emails_each]"]').removeAttr("disabled")});if(f("#bounce-process-auto").attr("checked")){f("#bounce-frequency").show()}else{f("#bounce-frequency").hide()}f("#bounce-process-auto").change(function(){if(f(this).attr("checked")){f("#bounce-frequency").show()}else{f("#bounce-frequency").hide()}});f(".activateInput").change(d);function d(){if(typeof(this)!=="undefined"){f.each(f(".activateInput"),function(){j(this)})}else{j(this)}}function j(k){if(f(k).attr("checked")){f("#"+f(k).attr("id")+"_linkname").show()}else{f("#"+f(k).attr("id")+"_linkname").hide()}}f("#wysija-innertabs a").live("click",function(){f("#wysija-innertabs a").removeClass("nav-tab-active");f(this).addClass("nav-tab-active");f(".wysija-innerpanel").hide();if(f(f(this).attr("href")).length>0){f(f(this).attr("href")).show()}f(this).blur();return false});f("#wysija-tabs a").live("click",function(){f("#wysija-tabs a").removeClass("nav-tab-active");f(this).addClass("nav-tab-active");f(".wysija-panel").hide();if(f(f(this).attr("href")).length>0){f(f(this).attr("href")).show();window.location.hash="tab-"+f(this).attr("href").substring(1)}f(this).blur();return false});f(document).ready(function(){g();a();i();d();f(".wysija-panel").hide();f(".wysija-innerpanel").hide();if(window.location.hash.length>0){var k="#"+window.location.hash.substring(5);f('#wysija-tabs a[href="'+k+'"]').trigger("click")}else{f("#wysija-tabs .nav-tab-active").trigger("click")}f("#wysija-innertabs .nav-tab-active").trigger("click")});f("#dkimpub, #domainrecord").focus(function(){this.select()});f("#dkimpub, #domainrecord").click(function(){this.select()});f("#dkimpub, #domainrecord").mouseup(function(){this.select()})});