Store
=============

BRANCH BRANCH BRANCH » DEVELOPMENT (ALL FORMS STUFF, **ALL SERVER ONLY**)

»» INCLUDE FORMS ONLY AS ADDED VALUE TO JS ADAPTER » IT'S A SERVER FEATURE ONLY *

CHECK VS POST SERVLET ?! YUUU, WHY NOT :D

A lightweight datastore wrapper providing CRUD operations for arbitrary objects. 

Index
-------------
* [Quickstart](#quickstart)
  * [Embedding](#embedding)
  * [Defaults](#defaults)
  * [Store](#create-store)
      * [Create](#create-store)
  * [Object](#create-object)
      * [Create](#create-object)
      * [Store](#store-object)
      * [Remove](#remove-object)
  * [Summary](#summary)
* [Repositories](#repositories)
* [Documentation](#documentation)
* [Roadmap](#roadmap)
* [License](#license)

Quickstart
-------------

### Embedding

#### Require.js
```html
<script>
require({paths: {store: 'dist/store-min'}}, ['store'], function(Store) {
  console.log("Store", Store);
});
</script>
```

#### ...
```html
<script src="src/client/store.js"></script>
<script>
  console.log("Store", Store);
</script>
```

### Defaults

Defaults are modified as follows:

```javascript
Store.configure({ 
  url: "http://localhost/datastore.php", 
  ttl: 36000
});
```
**Note**

`configure()` alters the prototype object, therefore modifications are propagated to it's instances on property level given that the respective instance property has not been modified directly yet.

### Create Store
```javascript
var objectStore = new Store({ namespace: 'object' });
```

### Create Object

#### Preset 
```javascript
var object = objectStore.create({ 
  country: 'USA', 
  firstname: 'Stephen', 
  lastname: 'Colbert' 
}); 
```

#### Barebone
```javascript
var object = objectStore.create(); 
object.set('country', 'USA');
object.set('firstname', 'John'); 
object.set('lastname', 'Stewart'); 
```

### Get Object

#### List
```javascript
objectStore.list();
```

#### Single
```javascript
objectStore.get('8c0c1ff0-d0fe-38b7-376a-b0b1d53bd557');
```

### Store Object

#### Instance
```javascript
object.update();
```

#### Datastore
```javascript
objectStore.update(object);
```

#### Datastore w/ arbitrary object
```javascript
objectStore.update({ name: 'XXXXX', type: 'XXXXX', rank: 'XXXXX' });
```

### Remove Object

#### Instance
```javascript
object.remove();
```

#### Datastore
```javascript
objectStore.remove(object);
```

### Summary
```html
<script src="src/client/store.js"></script>
<script>
(function(root){

  // local variables
  var objectStore, objects, object;

  // configure storage defaults 
  Store.configure({ 
    url: "http://localhost/datastore.php", 
    ttl: 36000
  });

  // create new storage
  objectStore = new Store({ namespace: 'object' });

  // create new storage bound object
  object = objectStore.create({ 
    country: 'US', 
    firstname: 'Stephen', 
    lastname: 'Colbert' 
  });
  
  // insert object
  object = object.update();

  // update on insert
  Store.when(object).done(function(object){
  
    // update properties
    object.set('firstname', 'John');
    object.set('lastname', 'Stewart');

    // update object
    object.update();

  });

  // collect update promises
  objects = [];

  // create some objects
  Store.times(10, function(count){
    objects.push(objectStore.create({ 
      title: 'No.' + count,       
      abstract: 'Lorem Ipsum [...]',       
      text: 'Lorem Ipsum Si Amet They Say',             
      author: 'me', 
      lastmod: new Date().getTime()
    }).update());
  });

  // upon promises fulfillment
  Store.when(objects)
    .done(function(objects){
      console.log("done", objects);
    })
    .fail(function(objects){
      console.log("fail", objects);
    })
    .always(function(objects){
      console.log("always", objects);
    });  

  // fetch all objects & register callback 
  objects = objectStore.list();

  // process fetched objects
  Store.when(objects).done(function(objects){
    objects.forEach(function(object, index){
      console.log(index, object);
    });
  });

  // fetch object 
  object = objectStore.get('8c0c1ff0-d0fe-38b7-376a-b0b1d53bd557');

  // process fetched object
  Store.when(object).done(function(object){
    console.log("object", object);
  });
});
</script>
```

### Files
```html
<script>
  // create container
  var form = new FormData();
   
  // configure
  form.append('namespace', 'object');
  form.append('action', 'update');  

  // attach file
  form.append('instance[document]', new Blob(['<file>...</file>'], { type: 'text/xml' }));
   
  // store
  var request = new XMLHttpRequest();
  request.open('post', 'http://localhost/datastore.php');
  request.send(form);
</script>
```

### HTML

#### Default Form Handler
```html
<form method="post" action="datastore.php">  
  <input type="hidden" name="namespace" value="object"/>
  <input type="hidden" name="instance[id]" value="a5b1da03-c0d1-5f49-19e4-de94bb266d2e"/>
  <input type="text" name="instance[firstname]" value="firstname"/>
  <input type="text" name="instance[lastname]" value="lastname"/>
  <input type="submit" name="action" value="update"/>
  <input type="submit" name="action" value="remove"/>
  <input type="submit" name="action" value="cancel"/>
</form>
```

#### Custom Form Handler
```html
<form method="post" action="#" data-store="objectStore">
  <input type="text" name="instance[firstname]" value="firstname"/>
  <input type="text" name="instance[lastname]" value="lastname"/>
  <input type="submit" name="action" value="update"/>
  <input type="submit" name="action" value="remove"/>
  <input type="submit" name="action" value="cancel"/>
</form>
```

#### Files
```html
<form method="post" action="datastore.php" enctype="multipart/form-data">  
  <input type="hidden" name="namespace" value="object"/>
  <input type="hidden" name="instance[id]" value="55ff1e53-0bab-f317-d1d2-7e119fce405e9"/>
  <input type="file" name="instance[document]" />
  <input type="file" name="instance[audio]" />
  <input type="file" name="instance[video]" />
  <input type="file" name="instance[image]" />
  <input type="submit" name="action" value="update"/>
  <input type="submit" name="action" value="remove"/>
  <input type="submit" name="action" value="cancel"/>
</form>
```

#### REST API

##### Put
```html
<form method="put" action="datastore.php">
  <input type="hidden" name="namespace" value="object"/>
  <input type="text" name="instance[firstname]" value="firstname"/>
  <input type="text" name="instance[lastname]" value="lastname"/>
  <button>put</button>
</form>
```

##### Post
```html
<form method="post" action="datastore.php">
  <input type="hidden" name="namespace" value="object"/>
  <input type="text" name="instance[firstname]" value="firstname"/>
  <input type="text" name="instance[lastname]" value="lastname"/>
  <button>post</button>
</form>
```

##### Get
```html
<form method="get" action="datastore.php">
  <input type="hidden" name="namespace" value="object"/>
  <input type="text" name="instance[id]" value="55ff1e53-0bab-f317-d1d2-7e119fce405e9"/>
  <button>get</button>
</form>
```

##### Delete
```html
<form method="delete" action="datastore.php">
  <input type="hidden" name="namespace" value="object"/>
  <input type="text" name="instance[id]" value="55ff1e53-0bab-f317-d1d2-7e119fce405e9"/>
  <button>delete</button>
</form>
```

Repositories
-------------

### PHP Store

Stores data using PHPs object serialization features for marshalling. Supports embedding files base64 encoded.

**Limitations** 

Built with prototyping in mind. Won't scale.

Documentation
-------------
- [API Docs](https://github.com/alternatex/store/blob/master/docs/api/index.html)
- [Usage](https://github.com/alternatex/store/blob/master/docs/index.md)

Roadmap
-------------
- Adapters/Stores/Repositories
  - Remote/PHP Plain
- AMD/CommonJS 
- Custom Form Handler
- Documentation
- Test Coverage

Wishlist
-------------
- REST Client/PHP-Adapter
- Filters JS/PHP
- Repositories Node.js Plain & PHPCR
- HTML5 FileSystem API
- JSON Schema

License
-------------
Released under two licenses: new BSD, and MIT. You may pick the
license that best suits your development needs.

https://raw.github.com/alternatex/store/master/LICENSE