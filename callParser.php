<?php
//Media Wiki Extension - Custom Tags
//For ICT-Beta Service Balie internal use
//For ITS/FSC Calls
//Daan Knoope, 13-02-2015 


$wgHooks['ParserFirstCallInit'][] = 'wfCallParserInit';

function wfCallParserInit(Parser $parser){
	$parser->setHook('call', 'callRender');
	return true;
}

function callRender($input, array $args, Parser $parser, PPFrame $frame){
	$itsLink = "https://ict-servicedesk.uu.nl/tas/secure/incident?action=lookup&lookup=naam&lookupValue=";
	$fscLink = "https://tas.fsc.uu.nl/tas/public/index.jsp";
	$parsedInput = preg_replace('/\s+/', '', $input);
	if($parsedInput[0] == 'S')
		return  "<a href=\"" . $itsLink . $parsedInput . "\">" . $parsedInput . "</a>";
	else if($parsedInput[0] == 'F')
		return "<a href=\"" . $fscLink .  "\">" . $parsedInput . "</a>";
	else
		return $input;
}
