// need to mash the routes into the example json format above

{
	"config": "core",
	"namespace": "\erdiko\modules",
	"modules": [
		"file": {
			"name": "file",
			"class":  "File",
			"active": 1
		  },
		"memcache": {
			"name": "memcache",
			"class":  "Memcache",
			"active": 1
		  },
		"cache": {
			"name": "cache",
			"class":  "Cache",
			"active": 1
		  },
		"facebook": {
			"name": "file",
			"class":  "File",
			"active": 1
		  },
		"facebook": {
			"name": "file",
			"class":  "File",
			"active": 1
		  }
    ]
}


$routes = array(
		array('/', '\erdiko\core\Handler'),
		array('test/([a-zA-Z0-9_/]+)', '\erdiko\core\Handler'),
		array("theme/([a-zA-Z0-9_/]+)/([a-zA-Z0-9_/]+)", '\erdiko\modules\theme\Handler'),
		array("([0-9][0-9][0-9][0-9])/([a-zA-Z0-9_/]+)", '\erdiko\core\Handler'),
		array("([a-zA-Z0-9_]+)", '\erdiko\core\Handler'),
		// array("([0-9]{4})", '\erdiko\core\Handler'),
		array("([0-9][0-9][0-9][0-9])/([a-zA-Z0-9_/]+)", '\erdiko\core\Handler'),
	);
	
	