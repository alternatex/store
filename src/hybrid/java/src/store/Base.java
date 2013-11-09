package store;
import haxe.root.*;
@SuppressWarnings(value={"rawtypes", "unchecked"})
public  class Base extends haxe.lang.HxObject
{
	public    Base()
	{
		super();
		store.Base.__hx_ctor(this);
	}
	
	
	public static   void __hx_ctor(store.Base __temp_me8)
	{
		__temp_me8.namexxx = "test";
	}
	
	
	public static   java.lang.Object __hx_createEmpty()
	{
		return new store.Base(haxe.lang.EmptyObject.EMPTY);
	}
	
	
	public static   java.lang.Object __hx_create(haxe.root.Array arr)
	{
		return new store.Base();
	}
	
	
	public    Base(haxe.lang.EmptyObject empty)
	{
		super();
	}
	
	
	public  java.lang.String namexxx;
	
	@Override public   java.lang.Object __hx_setField(java.lang.String field, java.lang.Object value, boolean handleProperties)
	{
		{
			boolean __temp_executeDef69 = true;
			switch (field.hashCode())
			{
				case 1721976589:
				{
					if (field.equals("namexxx")) 
					{
						__temp_executeDef69 = false;
						return this.namexxx = haxe.lang.Runtime.toString(value);
					}
					
					break;
				}
				
				
			}
			
			if (__temp_executeDef69) 
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
			boolean __temp_executeDef70 = true;
			switch (field.hashCode())
			{
				case 1721976589:
				{
					if (field.equals("namexxx")) 
					{
						__temp_executeDef70 = false;
						return this.namexxx;
					}
					
					break;
				}
				
				
			}
			
			if (__temp_executeDef70) 
			{
				return super.__hx_getField(field, throwErrors, isCheck, handleProperties);
			}
			 else 
			{
				throw null;
			}
			
		}
		
	}
	
	
	@Override public   void __hx_getFields(haxe.root.Array<java.lang.String> baseArr)
	{
		baseArr.push("namexxx");
		{
			super.__hx_getFields(baseArr);
		}
		
	}
	
	
}


