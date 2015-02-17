<?php
//Media Wiki Extension - Custom Tags
//For ICT-Beta Service Balie internal use
//For ITS/FSC Calls
//Daan Knoope, 17-02-2015
 
$wgHooks['ParserFirstCallInit'][] = 'wfCallParserInit';

function wfCallParserInit(Parser $parser){
	$parser->setHook('call', 'callRender');
	return true; //requirement of media wiki
}

function callRender($input, array $args, Parser $parser, PPFrame $frame){
	$itsLink = "https://ict-servicedesk.uu.nl/tas/secure/incident?action=lookup&lookup=naam&lookupValue=";
	$fscLink = "https://meldformulier.fsc.uu.nl/tas/public/incidentpublic?action=fastsearch&queryfield=";
	$warningImg = "https://studentassistenten.science.uu.nl/images/6/61/Warning_page.png";
	$parsedInput = preg_replace('/\s+/', '', $input);
	if($parsedInput[0] == 'S')
		return  "<a href=\"" . $itsLink . $parsedInput . "\">" . $parsedInput . "</a>";
	else if($parsedInput[0] == 'F'){
		//FSC Calls require a special structure, this makes sure the right one is used
		$formattedCallTag = substr($parsedInput,0,3) . " " . substr($parsedInput,3,2) . " " . substr($parsedInput,5);
		return "<a href=\"" . $fscLink . $formattedCallTag . "\">" . $formattedCallTag . "</a>";
		}
	else
		return "<span title=\"Invalid Call ID\">" . $input . "<img src=\"" . $warningImg . "\" /></span>";
		

}
