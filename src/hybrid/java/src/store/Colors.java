package store;
import haxe.root.*;
@SuppressWarnings(value={"rawtypes", "unchecked"})
public  class Colors extends haxe.lang.HxObject
{
	public    Colors()
	{
		super();
	}
	
	
	public static   int toInt(store.Color c)
	{
		int __temp_stmt68 = 0;
		switch (haxe.root.Type.enumIndex((c)))
		{
			case 0:
			{
				__temp_stmt68 = 16711680;
				break;
			}
			
			
			case 1:
			{
				__temp_stmt68 = 65280;
				break;
			}
			
			
			case 2:
			{
				__temp_stmt68 = 255;
				break;
			}
			
			
		}
		
		return __temp_stmt68;
	}
	
	
	public static   java.lang.Object __hx_createEmpty()
	{
		return new store.Colors(haxe.lang.EmptyObject.EMPTY);
	}
	
	
	public static   java.lang.Object __hx_create(haxe.root.Array arr)
	{
		return new store.Colors();
	}
	
	
	public    Colors(haxe.lang.EmptyObject empty)
	{
		super();
	}
	
	
}


