<?php
function adminer_object() {
	// required to run any plugin
	include_once "./plugins/plugin.php";
	
	// autoloader
	foreach (glob("./plugins/*.php") as $filename) {
		include_once $filename;
	}
	
	// enable extra drivers just by including them
	//~ include "../plugins/drivers/simpledb.php";
	
	$plugins = array(
		// specify enabled plugins here
		new AdminerDatabaseHide(array('information_schema')),
		new AdminerDumpJson,
		new AdminerDumpBz2,
		new AdminerDumpZip,
		new AdminerDumpXml,
		new AdminerDumpAlter,
		//~ new AdminerSqlLog("past-" . rtrim(`git describe --tags --abbrev=0`) . ".sql"),
		//~ new AdminerEditCalendar(script_src("../externals/jquery-ui/jquery-1.4.4.js") . script_src("../externals/jquery-ui/ui/jquery.ui.core.js") . script_src("../externals/jquery-ui/ui/jquery.ui.widget.js") . script_src("../externals/jquery-ui/ui/jquery.ui.datepicker.js") . script_src("../externals/jquery-ui/ui/jquery.ui.mouse.js") . script_src("../externals/jquery-ui/ui/jquery.ui.slider.js") . script_src("../externals/jquery-timepicker/jquery-ui-timepicker-addon.js") . "<link rel='stylesheet' href='../externals/jquery-ui/themes/base/jquery.ui.all.css'>\n<style>\n.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }\n.ui-timepicker-div dl { text-align: left; }\n.ui-timepicker-div dl dt { height: 25px; }\n.ui-timepicker-div dl dd { margin: -25px 0 10px 65px; }\n.ui-timepicker-div td { font-size: 90%; }\n</style>\n", "../externals/jquery-ui/ui/i18n/jquery.ui.datepicker-%s.js"),
		//~ new AdminerTinymce("../externals/tinymce/jscripts/tiny_mce/tiny_mce_dev.js"),
		//~ new AdminerWymeditor(array("../externals/wymeditor/src/jquery/jquery.js", "../externals/wymeditor/src/wymeditor/jquery.wymeditor.js", "../externals/wymeditor/src/wymeditor/jquery.wymeditor.explorer.js", "../externals/wymeditor/src/wymeditor/jquery.wymeditor.mozilla.js", "../externals/wymeditor/src/wymeditor/jquery.wymeditor.opera.js", "../externals/wymeditor/src/wymeditor/jquery.wymeditor.safari.js")),
		new AdminerFileUpload(""),
		new AdminerJsonColumn,
		new AdminerSlugify,
		new AdminerTranslation,
		new AdminerForeignSystem,
		new AdminerEnumOption,
		new AdminerTablesFilter,
		new AdminerEditForeign,

		// @zgz 允许嵌入 iframe
		new AdminerFrames(),
		
		// @zgz
		// new AdminerLoginPasswordLess_zgz("normal"),
		// new AdminerLoginPasswordLess_zgz("token"),
		new AdminerLoginPasswordLess_zgz("none"),// 有安全风险！仅供调试！
		
		// 下载了依赖，汉化jquery-ui-timepicker-addon.min.js
		new AdminerEditCalendar(
			script_src("./externals/jquery-ui-1.8.24/jquery-1.8.2.js")
			 . script_src("./externals/jquery-ui-1.8.24/ui/jquery.ui.core.js")
			 . script_src("./externals/jquery-ui-1.8.24/ui/jquery.ui.widget.js")
			 . script_src("./externals/jquery-ui-1.8.24/ui/jquery.ui.datepicker.js")
			 . script_src("./externals/jquery-ui-1.8.24/ui/jquery.ui.mouse.js")
			 . script_src("./externals/jquery-ui-1.8.24/ui/jquery.ui.slider.js")
			 . script_src("./externals/jquery-ui-timepicker-addon.min.js")
			 . "<link rel='stylesheet' href='./externals/jquery-ui-1.8.24/themes/base/jquery.ui.all.css'>\n<style>\n.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }\n.ui-timepicker-div dl { text-align: left; }\n.ui-timepicker-div dl dt { height: 25px; }\n.ui-timepicker-div dl dd { margin: -25px 0 10px 65px; }\n.ui-timepicker-div td { font-size: 90%; }\n</style>\n"
			 , "./externals/jquery-ui-1.8.24/ui/i18n/jquery.ui.datepicker-%s.js"),

		new AdminerDesigns($arrayName = array(
			'http://127.0.0.1:8090/adminer-z-2.css' => '深色精简',
			'http://127.0.0.1:8090/adminer-z.css' => '浅色精简',
			'http://127.0.0.1:8090/designs/flat/adminer.css' => '浅色flat',
			'http://127.0.0.1:8090/designs/pepa-linha/adminer.css' => '浅色',
			'http://127.0.0.1:8090/designs/pepa-linha-dark/adminer.css' => '深色',
		)),

	);
	
	/* It is possible to combine customization and plugins:
	class AdminerCustomization extends AdminerPlugin {
	}
	return new AdminerCustomization($plugins);
	*/
	
	return new AdminerPlugin($plugins);
}

// include original Adminer or Adminer Editor (usually named adminer.php)
include "./adminer.php";
