function is_equal_to(obj1, obj2, msg)
{
	if(obj1.val() != obj2.val())
	{
		scroll_to_object(obj1, msg);
		return false;
	}
	else
		return true;
}

function has_value(obj, msg)
{
	if(obj.val() == null || obj.val()== '')
	{
		scroll_to_object(obj, msg);
		return false;
	}
	else
		return true;
}

function is_id_card_number(obj, msg)
{
	var id_card_number = obj.val();
	if(!check_is_id_card_number(id_card_number))
	{
		scroll_to_object(obj, msg);
		return false;
	}
	else
		return true;
}

function check_is_id_card_number(id_card_number)
{
	/*
	if (id_card_number.length != 10)
　　	return false;

　　var ID_Input = new Array(10)
　　for (var i=0; i<10; i++) 
	{ 
		ID_Input[i] = id.charAt(i);
	}
	
　　var EngString = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
　　ID_Input[0]　= EngString.indexOf(ID_Input[0]);
　　if (ID_Input[0] == -1)
		return false;
　　if (ID_Input[1] !=1 && ID_Input[1] !=2)
		return false;
　　var NumArray　= new Array(26)
　　NumArray[0]　　 = 1 ; NumArray[1]　　= 10; NumArray[2]　　= 19;
　　NumArray[3]　　 = 28; NumArray[4]　　= 37; NumArray[5]　　= 46;
　　NumArray[6]　　 = 55; NumArray[7]　　= 64; NumArray[8]　　= 39;
　　NumArray[9]　　 = 73; NumArray[10]   = 82; NumArray[11]   = 2 ;
　　NumArray[12]　　= 11; NumArray[13]   = 20; NumArray[14]   = 48;
　　NumArray[15]　　= 29; NumArray[16]   = 38; NumArray[17]   = 47;
　　NumArray[18]　　= 56; NumArray[19]   = 65; NumArray[20]   = 74;
　　NumArray[21]　　= 83; NumArray[22]   = 21; NumArray[23]   = 3 ;
　　NumArray[24]　　= 12; NumArray[25]   = 30;
　　var result = NumArray[ID_Input[0]];
　　for (var i=1; i<10; i++)
　　{
		var NumString = '0123456789';
		ID_Input[i] = NumString.indexOf(ID_Input[i])
		if (ID_Input[i] == -1)
			return false;
		else
			result += ID_Input[i] * (9-i);
　　}

　　result += 1 * ID_Input[9];
　　if (result % 10 != 0)
		return false;
　　return true;
	*/

	var tab = "ABCDEFGHJKLMNPQRSTUVXYWZIO";
	var A1 = new Array (1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3 );
	var A2 = new Array (0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5 );
	var Mx = new Array (9,8,7,6,5,4,3,2,1,1);

	if ( id_card_number.length != 10 ) 
		return false;

	i = tab.indexOf( id_card_number.charAt(0) );
	
	if ( i == -1 ) 
		return false;

	sum = A1[i] + A2[i]*9;

	for ( i=1; i<10; i++ ) 
	{
		v = parseInt( id_card_number.charAt(i) );
		if ( isNaN(v) ) 
			return false;
		sum = sum + v * Mx[i];
	}
	if ( sum % 10 != 0 )
	{
		reg = /^[A-Z]\d{9}$/;
		if (!reg.test(id_card_number))
		{
			return false;
		}
		else
		{
			var words = id_card_number.split('');
			
			var enum_letter = [
				{ code: 'A', number: 10 },{ code: 'B', number: 11 },{ code: 'C', number: 12 },
				{ code: 'D', number: 13 },{ code: 'E', number: 14 },{ code: 'F', number: 15 },
				{ code: 'G', number: 16 },{ code: 'H', number: 17 },{ code: 'I', number: 34 },
				{ code: 'J', number: 18 },{ code: 'K', number: 19 },{ code: 'L', number: 20 },
				{ code: 'M', number: 21 },{ code: 'N', number: 22 },{ code: 'O', number: 35 },
				{ code: 'P', number: 23 },{ code: 'Q', number: 24 },{ code: 'R', number: 25 },
				{ code: 'S', number: 26 },{ code: 'T', number: 27 },{ code: 'U', number: 28 },
				{ code: 'V', number: 29 },{ code: 'W', number: 32 },{ code: 'X', number: 30 },
				{ code: 'Y', number: 31 },{ code: 'Z', number: 33 }
			];
			for(var i = 0; i <= enum_letter.length - 1; i++)
			{
				if(words[0] == enum_letter[i].code)
					var code = enum_letter[i].number.toString().split('');
			}
			var number = 9;
			var total = parseInt(code[0])+(parseInt(code[1])*number);
			for(var i = 1; i <= words.length - 2; i++)
			{
				total += (number -i ) * parseInt(words[i]);
			}

			if(10 - (total % 10) == words[9])
				return true;
			else
				return false;
		}
	}
	return true;
	/*
	reg = /^[A-Z]\d{9}$/;
	if (!reg.test(id_card_number))
	{
		return false;
	}
	else
	{
		var words = id_card_number.split('');
		
		var enum_letter = [
			{ code: 'A', number: 10 },{ code: 'B', number: 11 },{ code: 'C', number: 12 },
			{ code: 'D', number: 13 },{ code: 'E', number: 14 },{ code: 'F', number: 15 },
			{ code: 'G', number: 16 },{ code: 'H', number: 17 },{ code: 'I', number: 34 },
			{ code: 'J', number: 18 },{ code: 'K', number: 19 },{ code: 'L', number: 20 },
			{ code: 'M', number: 21 },{ code: 'N', number: 22 },{ code: 'O', number: 35 },
			{ code: 'P', number: 23 },{ code: 'Q', number: 24 },{ code: 'R', number: 25 },
			{ code: 'S', number: 26 },{ code: 'T', number: 27 },{ code: 'U', number: 28 },
			{ code: 'V', number: 29 },{ code: 'W', number: 32 },{ code: 'X', number: 30 },
			{ code: 'Y', number: 31 },{ code: 'Z', number: 33 }
		];
		for(var i = 0; i <= enum_letter.length - 1; i++)
		{
			if(words[0] == enum_letter[i].code)
				var code = enum_letter[i].number.toString().split('');
		}
		var number = 9;
		var total = parseInt(code[0])+(parseInt(code[1])*number);
		for(var i = 1; i <= words.length - 2; i++)
		{
			total += (number -i ) * parseInt(words[i]);
		}

		if(10 - (total % 10) == words[9])
			return true;
		else
			return false;
	}
	*/
}

function is_validate_age_range(obj, birthday, max, min)
{
	if(parseInt(birthday) < parseInt(max) || parseInt(birthday) > parseInt(min))
	{
		scroll_to_object(obj, '參加者出年月日需介於'+max+'到'+min+'之間')
		return false;
	}
	else
		return true;
}

function at_least_has_one_checked(obj, msg)
{
	if(obj.filter(':checked').length == 0)
	{
		scroll_to_object(obj, msg)
		return false;
	}
	else
		return true;
}

function is_xor(obj1, obj2, val, msg)
{
	if(obj1.filter(':checked').length != 0 && obj2.filter(':checked').val() != val)
	{
		alert(msg);
		return false;
	}
	else
		return true;
}

function scroll_to_object(obj, msg)
{
	$('body').animate({
		scrollTop: obj.offset().top - 30
	}, 250, function(){
		obj.parent('div').addClass('has-error');
		alert(msg);
	});
}