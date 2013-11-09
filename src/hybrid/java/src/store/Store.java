package store;
import haxe.root.*;
@SuppressWarnings(value={"rawtypes", "unchecked"})
public  class Store extends store.Base
{
	public static void main(String[] args)
	{
		
		main();
	}
	static 
	{
		store.Store.REQUEST_HEADER_TYPE = "X-Store-Type";
		store.Store.RESPONSE_JSONP_ENABLED = true;
		store.Store.RESPONSE_JSONP_CALLBACK = "callback";
		store.Store.ENTITY_COUNT = "count";
		store.Store.ENTITY_IDENTIFIER = "id";
		store.Store.MESSAGE_ERROR_DATASTORE_CORRUPT = "DATASTORE IS CORRUPT";
		store.Store.MESSAGE_ERROR_DATASTORE_LOCKED = "DATASTORE IS LOCKED";
		store.Store.REQUEST_ACTION = "action";
		store.Store.REQUEST_NAMESPACE = "namespace";
		store.Store.REQUEST_DATA = "instance";
		store.Store.REQUEST_JSONP = "jsonp";
		store.Store.RESPONSE_ERROR = "error";
		store.Store.STORE_ACTION_GET = "get";
		store.Store.STORE_ACTION_LIST = "list";
		store.Store.STORE_ACTION_REMOVE = "remove";
		store.Store.STORE_ACTION_UPDATE = "update";
		store.Store.TRANSFER_SOURCE = "tmp_name";
		store.Store.TRANSFER_TARGET = "name";
	}
	public    Store()
	{
		super(haxe.lang.EmptyObject.EMPTY);
		store.Store.__hx_ctor(this);
	}
	
	
	public static   void __hx_ctor(store.Store __temp_me9)
	{
		__temp_me9.pending = true;
		store.Base.__hx_ctor(__temp_me9);
	}
	
	
	public static  java.lang.String REQUEST_HEADER_TYPE;
	
	public static  boolean RESPONSE_JSONP_ENABLED;
	
	public static  java.lang.String RESPONSE_JSONP_CALLBACK;
	
	public static  java.lang.String ENTITY_COUNT;
	
	public static  java.lang.String ENTITY_IDENTIFIER;
	
	public static  java.lang.String MESSAGE_ERROR_DATASTORE_CORRUPT;
	
	public static  java.lang.String MESSAGE_ERROR_DATASTORE_LOCKED;
	
	public static  java.lang.String REQUEST_ACTION;
	
	public static  java.lang.String REQUEST_NAMESPACE;
	
	public static  java.lang.String REQUEST_DATA;
	
	public static  java.lang.String REQUEST_JSONP;
	
	public static  java.lang.String RESPONSE_ERROR;
	
	public static  java.lang.String STORE_ACTION_GET;
	
	public static  java.lang.String STORE_ACTION_LIST;
	
	public static  java.lang.String STORE_ACTION_REMOVE;
	
	public static  java.lang.String STORE_ACTION_UPDATE;
	
	public static  java.lang.String TRANSFER_SOURCE;
	
	public static  java.lang.String TRANSFER_TARGET;
	
	public static   void test(java.lang.String test)
	{
		haxe.Log.trace.__hx_invoke2_o(0.0, 0.0, test, new haxe.lang.DynamicObject(new haxe.root.Array<java.lang.String>(new java.lang.String[]{"className", "fileName", "methodName"}), new haxe.root.Array<java.lang.Object>(new java.lang.Object[]{"store.Store", "Store.hx", "test"}), new haxe.root.Array<java.lang.String>(new java.lang.String[]{"lineNumber"}), new haxe.root.Array(new java.lang.Object[]{((java.lang.Object) (308) )})));
	}
	
	
	public static   void main()
	{
		store.plugins.resource.Resource resource = new store.plugins.resource.Resource(((int) (123) ));
		java.lang.Object mapping = new haxe.lang.DynamicObject(new haxe.root.Array<java.lang.String>(new java.lang.String[]{"create", "delete", "read", "update"}), new haxe.root.Array<java.lang.Object>(new java.lang.Object[]{store.Actions.create, store.Actions.delete, store.Actions.read, store.Actions.update}), new haxe.root.Array<java.lang.String>(new java.lang.String[]{}), new haxe.root.Array(new java.lang.Object[]{}));
		haxe.Log.trace.__hx_invoke2_o(0.0, 0.0, mapping, new haxe.lang.DynamicObject(new haxe.root.Array<java.lang.String>(new java.lang.String[]{"className", "fileName", "methodName"}), new haxe.root.Array<java.lang.Object>(new java.lang.Object[]{"store.Store", "Store.hx", "main"}), new haxe.root.Array<java.lang.String>(new java.lang.String[]{"lineNumber"}), new haxe.root.Array(new java.lang.Object[]{((java.lang.Object) (432) )})));
		haxe.Log.trace.__hx_invoke2_o(0.0, 0.0, "hey there! wazzup???", new haxe.lang.DynamicObject(new haxe.root.Array<java.lang.String>(new java.lang.String[]{"className", "fileName", "methodName"}), new haxe.root.Array<java.lang.Object>(new java.lang.Object[]{"store.Store", "Store.hx", "main"}), new haxe.root.Array<java.lang.String>(new java.lang.String[]{"lineNumber"}), new haxe.root.Array(new java.lang.Object[]{((java.lang.Object) (433) )})));
	}
	
	
	public static   java.lang.Object __hx_createEmpty()
	{
		return new store.Store(haxe.lang.EmptyObject.EMPTY);
	}
	
	
	public static   java.lang.Object __hx_create(haxe.root.Array arr)
	{
		return new store.Store();
	}
	
	
	public    Store(haxe.lang.EmptyObject empty)
	{
		super(haxe.lang.EmptyObject.EMPTY);
	}
	
	
	public   void mirror()
	{
		haxe.Log.trace.__hx_invoke2_o(0.0, 0.0, "mirror", new haxe.lang.DynamicObject(new haxe.root.Array<java.lang.String>(new java.lang.String[]{"className", "fileName", "methodName"}), new haxe.root.Array<java.lang.Object>(new java.lang.Object[]{"store.Store", "Store.hx", "mirror"}), new haxe.root.Array<java.lang.String>(new java.lang.String[]{"lineNumber"}), new haxe.root.Array(new java.lang.Object[]{((java.lang.Object) (390) )})));
	}
	
	
	public   boolean isPending(java.lang.Object pending)
	{
		if (( ! (( pending == null )) )) 
		{
			this.pending = haxe.lang.Runtime.toBool(pending);
		}
		
		return this.pending;
	}
	
	
	public   boolean persist(java.lang.String dsn)
	{
		return true;
	}
	
	
	public   void load(java.lang.String dsn)
	{
		{
		}
		
	}
	
	
	public   void remove(store.plugins.resource.Resource resource)
	{
		{
		}
		
	}
	
	
	public   void get(store.plugins.resource.Resource resource)
	{
		{
		}
		
	}
	
	
	public   void update(store.plugins.resource.Resource resource)
	{
		{
		}
		
	}
	
	
	public  java.lang.Object datastore;
	
	public  haxe.root.Array<store.Item> items;
	
	public  boolean pending;
	
	@Override public   double __hx_setField_f(java.lang.String field, double value, boolean handleProperties)
	{
		{
			boolean __temp_executeDef71 = true;
			switch (field.hashCode())
			{
				case -344898697:
				{
					if (field.equals("datastore")) 
					{
						__temp_executeDef71 = false;
						return haxe.lang.Runtime.toDouble(this.datastore = ((java.lang.Object) (value) ));
					}
					
					break;
				}
				
				
			}
			
			if (__temp_executeDef71) 
			{
				return super.__hx_setField_f(field, value, handleProperties);
			}
			 else 
			{
				throw null;
			}
			
		}
		
	}
	
	
	@Override public   java.lang.Object __hx_setField(java.lang.String field, java.lang.Object value, boolean handleProperties)
	{
		{
			boolean __temp_executeDef72 = true;
			switch (field.hashCode())
			{
				case -682587753:
				{
					if (field.equals("pending")) 
					{
						__temp_executeDef72 = false;
						return this.pending = haxe.lang.Runtime.toBool(value);
					}
					
					break;
				}
				
				
				case -344898697:
				{
					if (field.equals("datastore")) 
					{
						__temp_executeDef72 = false;
						return this.datastore = ((java.lang.Object) (value) );
					}
					
					break;
				}
				
				
				case 100526016:
				{
					if (field.equals("items")) 
					{
						__temp_executeDef72 = false;
						return this.items = ((haxe.root.Array<store.Item>) (value) );
					}
					
					break;
				}
				
				
			}
			
			if (__temp_executeDef72) 
			{
				return super.__hx_setField(field, value, handleProperties);
			}
			 else 
			{
				throw null;
			}
			
		}
		
	}
	
	
	@Override public   java.lang.Object __hx_getField(java.lang.String field, boolean throwErrors, boolean isCheck, boolean handleProperties)
	{
		{
			boolean __temp_executeDef73 = true;
			switch (field.hashCode())
			{
				case -682587753:
				{
					if (field.equals("pending")) 
					{
						__temp_executeDef73 = false;
						return this.pending;
					}
					
					break;
				}
				
				
				case -1073910849:
				{
					if (field.equals("mirror")) 
					{
						__temp_executeDef73 = false;
						return new haxe.lang.Closure(this, "mirror");
					}
					
					break;
				}
				
				
				case 100526016:
				{
					if (field.equals("items")) 
					{
						__temp_executeDef73 = false;
						return this.items;
					}
					
					break;
				}
				
				
				case -1262366451:
				{
					if (field.equals("isPending")) 
					{
						__temp_executeDef73 = false;
						return new haxe.lang.Closure(this, "isPending");
					}
					
					break;
				}
				
				
				case -344898697:
				{
					if (field.equals("datastore")) 
					{
						__temp_executeDef73 = false;
						return this.datastore;
					}
					
					break;
				}
				
				
				case -678446636:
				{
					if (field.equals("persist")) 
					{
						__temp_executeDef73 = false;
						return new haxe.lang.Closure(this, "persist");
					}
					
					break;
				}
				
				
				case -838846263:
				{
					if (field.equals("update")) 
					{
						__temp_executeDef73 = false;
						return new haxe.lang.Closure(this, "update");
					}
					
					break;
				}
				
				
				case 3327206:
				{
					if (field.equals("load")) 
					{
						__temp_executeDef73 = false;
						return new haxe.lang.Closure(this, "load");
					}
					
					break;
				}
				
				
				case 102230:
				{
					if (field.equals("get")) 
					{
						__temp_executeDef73 = false;
						return new haxe.lang.Closure(this, "get");
					}
					
					break;
				}
				
				
				case -934610812:
				{
					if (field.equals("remove")) 
					{
						__temp_executeDef73 = false;
						return new haxe.lang.Closure(this, "remove");
					}
					
					break;
				}
				
				
			}
			
			if (__temp_executeDef73) 
			{
				return super.__hx_getField(field, throwErrors, isCheck, handleProperties);
			}
			 else 
			{
				throw null;
			}
			
		}
		
	}
	
	
	@Override public   double __hx_getField_f(java.lang.String field, boolean throwErrors, boolean handleProperties)
	{
		{
			boolean __temp_executeDef74 = true;
			switch (field.hashCode())
			{
				case -344898697:
				{
					if (field.equals("datastore")) 
					{
						__temp_executeDef74 = false;
						return haxe.lang.Runtime.toDouble(this.datastore);
					}
					
					break;
				}
				
				
			}
			
			if (__temp_executeDef74) 
			{
				return super.__hx_getField_f(field, throwErrors, handleProperties);
			}
			 else 
			{
				throw null;
			}
			
		}
		
	}
	
	
	@Override public   java.lang.Object __hx_invokeField(java.lang.String field, haxe.root.Array dynargs)
	{
		{
			boolean __temp_executeDef75 = true;
			switch (field.hashCode())
			{
				case -838846263:
				{
					if (field.equals("update")) 
					{
						__temp_executeDef75 = false;
						this.update(((store.plugins.resource.Resource) (dynargs.__get(0)) ));
						return null;
					}
					
					break;
				}
				
				
				case -1073910849:
				{
					if (field.equals("mirror")) 
					{
						__temp_executeDef75 = false;
						this.mirror();
						return null;
					}
					
					break;
				}
				
				
				case 102230:
				{
					if (field.equals("get")) 
					{
						__temp_executeDef75 = false;
						this.get(((store.plugins.resource.Resource) (dynargs.__get(0)) ));
						return null;
					}
					
					break;
				}
				
				
				case -1262366451:
				{
					if (field.equals("isPending")) 
					{
						__temp_executeDef75 = false;
						return this.isPending(dynargs.__get(0));
					}
					
					break;
				}
				
				
				case -934610812:
				{
					if (field.equals("remove")) 
					{
						__temp_executeDef75 = false;
						this.remove(((store.plugins.resource.Resource) (dynargs.__get(0)) ));
						return null;
					}
					
					break;
				}
				
				
				case -678446636:
				{
					if (field.equals("persist")) 
					{
						__temp_executeDef75 = false;
						return this.persist(haxe.lang.Runtime.toString(dynargs.__get(0)));
					}
					
					break;
				}
				
				
				case 3327206:
				{
					if (field.equals("load")) 
					{
						__temp_executeDef75 = false;
						this.load(haxe.lang.Runtime.toString(dynargs.__get(0)));
						return null;
					}
					
					break;
				}
				
				
			}
			
			if (__temp_executeDef75) 
			{
				return super.__hx_invokeField(field, dynargs);
			}
			 else 
			{
				throw null;
			}
			
		}
		
	}
	
	
	@Override public   void __hx_getFields(haxe.root.Array<java.lang.String> baseArr)
	{
		baseArr.push("pending");
		baseArr.push("items");
		baseArr.push("datastore");
		{
			super.__hx_getFields(baseArr);
		}
		
	}
	
	
}


