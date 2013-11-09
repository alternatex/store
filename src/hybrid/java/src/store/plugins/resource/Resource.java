package store.plugins.resource;
import haxe.root.*;
@SuppressWarnings(value={"rawtypes", "unchecked"})
public  class Resource extends haxe.lang.HxObject
{
	public    Resource(int data)
	{
		super();
		store.plugins.resource.Resource.__hx_ctor(this, data);
	}
	
	
	public static   void __hx_ctor(store.plugins.resource.Resource __temp_me10, int data)
	{
		__temp_me10.data(data);
	}
	
	
	public static   java.lang.Object __hx_createEmpty()
	{
		return new store.plugins.resource.Resource(haxe.lang.EmptyObject.EMPTY);
	}
	
	
	public static   java.lang.Object __hx_create(haxe.root.Array arr)
	{
		return new store.plugins.resource.Resource(haxe.lang.Runtime.toInt(arr.__get(0)));
	}
	
	
	public    Resource(haxe.lang.EmptyObject empty)
	{
		super();
	}
	
	
	public   java.lang.Object data(java.lang.Object data)
	{
		if (( ! (( data == null )) )) 
		{
			this.__data = data;
		}
		
		return this.__data;
	}
	
	
	public  java.lang.Object __data;
	
	@Override public   double __hx_setField_f(java.lang.String field, double value, boolean handleProperties)
	{
		{
			boolean __temp_executeDef76 = true;
			switch (field.hashCode())
			{
				case -1484387446:
				{
					if (field.equals("__data")) 
					{
						__temp_executeDef76 = false;
						return haxe.lang.Runtime.toDouble(this.__data = ((java.lang.Object) (value) ));
					}
					
					break;
				}
				
				
			}
			
			if (__temp_executeDef76) 
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
			boolean __temp_executeDef77 = true;
			switch (field.hashCode())
			{
				case -1484387446:
				{
					if (field.equals("__data")) 
					{
						__temp_executeDef77 = false;
						return this.__data = ((java.lang.Object) (value) );
					}
					
					break;
				}
				
				
			}
			
			if (__temp_executeDef77) 
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
			boolean __temp_executeDef78 = true;
			switch (field.hashCode())
			{
				case -1484387446:
				{
					if (field.equals("__data")) 
					{
						__temp_executeDef78 = false;
						return this.__data;
					}
					
					break;
				}
				
				
				case 3076010:
				{
					if (field.equals("data")) 
					{
						__temp_executeDef78 = false;
						return new haxe.lang.Closure(this, "data");
					}
					
					break;
				}
				
				
			}
			
			if (__temp_executeDef78) 
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
			boolean __temp_executeDef79 = true;
			switch (field.hashCode())
			{
				case -1484387446:
				{
					if (field.equals("__data")) 
					{
						__temp_executeDef79 = false;
						return haxe.lang.Runtime.toDouble(this.__data);
					}
					
					break;
				}
				
				
			}
			
			if (__temp_executeDef79) 
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
			boolean __temp_executeDef80 = true;
			switch (field.hashCode())
			{
				case 3076010:
				{
					if (field.equals("data")) 
					{
						__temp_executeDef80 = false;
						return this.data(dynargs.__get(0));
					}
					
					break;
				}
				
				
			}
			
			if (__temp_executeDef80) 
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
		baseArr.push("__data");
		{
			super.__hx_getFields(baseArr);
		}
		
	}
	
	
}


