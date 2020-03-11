<!-- ***************************************************
********************************************************
HOW TOasdf USE: Use these code examples as a guideliasdfne for formatting your HTML email. You may want to create your own template based on these snippets or just pick and choose the ones that fix your specific rendering issue(s). There are two main areas in the template: 1. The header (head) area of the document. You will find global styles, where indicated, to move inline. 2. The body section contains more specific fixes and guidance to use where needed in your design.
DO NOT COPY OVER COMMENTS AND INSTRUCTIONS WITH THE CODE to your message or risk spam box banishment :).
It is important to note that sometimes the styles in the header area should not be or don't need to be brought inline. Those instances will be marked accordingly in the comments.
********************************************************
**************************************************** -->

<!-- Using the xHTML doctype is a good practice when sending HTML email. While not the only doctype you can use, it seems to have the least inconsistencies. For more information on which one may work best for you, check out the resources below.
UPDATED: Now using xHTML strict based on the fact that gmail and hotmail uses it.  Find out more about that, and another great boilerplate, here: http://www.emailology.org/#1
More info/Reference on doctypes in email:
Campaign Monitor - http://www.campaignmonitor.com/blog/post/3317/correct-doctype-to-use-in-html-email/
Email on Acid - http://www.emailonacid.com/blog/details/C18/doctype_-_the_black_sheep_of_html_email_design
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Entecki - Relatório de Empreendimento</title>
	<style type="text/css">

		/***********
		Originally based on The MailChimp Reset from Fabio Carneiro, MailChimp User Experience Design
		More info and templates on Github: https://github.com/mailchimp/Email-Blueprints
		http://www.mailchimp.com &amp; http://www.fabio-carneiro.com
		INLINE: No.
		***********/
		/* Client-specific Styles */
		#outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
		body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
		/* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
		.ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
		.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ */
		#backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
		/* End reset */

		/* Some sensible defaults for images
		1. "-ms-interpolation-mode: bicubic" works to help ie properly resize images in IE. (if you are resizing them using the width and height attributes)
		2. "border:none" removes border when linking images.
		3. Updated the common Gmail/Hotmail image display fix: Gmail and Hotmail unwantedly adds in an extra space below images when using non IE browsers. You may not always want all of your images to be block elements. Apply the "image_fix" class to any image you need to fix.
		Bring inline: Yes.
		*/
		img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;}
		a img {border:none;}
		.image_fix {display:block;}

		/** Yahoo paragraph fix: removes the proper spacing or the paragraph (p) tag. To correct we set the top/bottom margin to 1em in the head of the document. Simple fix with little effect on other styling. NOTE: It is also common to use two breaks instead of the paragraph tag but I think this way is cleaner and more semantic. NOTE: This example recommends 1em. More info on setting web defaults: http://www.w3.org/TR/CSS21/sample.html or http://meiert.com/en/blog/20070922/user-agent-style-sheets/
		Bring inline: Yes.
		**/
		p {margin: 1em 0;}

		/** Hotmail header color reset: Hotmail replaces your header color styles with a green color on H2, H3, H4, H5, and H6 tags. In this example, the color is reset to black for a non-linked header, blue for a linked header, red for an active header (limited support), and purple for a visited header (limited support).  Replace with your choice of color. The !important is really what is overriding Hotmail's styling. Hotmail also sets the H1 and H2 tags to the same size.
		Bring inline: Yes.
		**/
		h1, h2, h3, h4, h5, h6 {color: black !important;}

		h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: blue !important;}

		h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {
			color: red !important; /* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */
		 }

		h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
			color: purple !important; /* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */
		}

		/** Outlook 07, 10 Padding issue: These "newer" versions of Outlook add some padding around table cells potentially throwing off your perfectly pixeled table.  The issue can cause added space and also throw off borders completely.  Use this fix in your header or inline to safely fix your table woes.
		More info: http://www.ianhoar.com/2008/04/29/outlook-2007-borders-and-1px-padding-on-table-cells/
		http://www.campaignmonitor.com/blog/post/3392/1px-borders-padding-on-table-cells-in-outlook-07/
		H/T @edmelly
		Bring inline: No.
		**/
		table td {border-collapse: collapse;}

		/** Remove spacing around Outlook 07, 10 tables
		More info : http://www.campaignmonitor.com/blog/post/3694/removing-spacing-from-around-tables-in-outlook-2007-and-2010/
		Bring inline: Yes
		**/
		table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;}
		/* Styling your links has become much simpler with the new Yahoo.  In fact, it falls in line with the main credo of styling in email, bring your styles inline.  Your link colors will be uniform across clients when brought inline.
		Bring inline: Yes. */
		a {color: orange;}

		/* Or to go the gold star route...
		a:link { color: orange; }
		a:visited { color: blue; }
		a:hover { color: green; }
		*/

		/***************************************************
		****************************************************
		MOBILE TARGETING
		Use @media queries with care.  You should not bring these styles inline -- so it's recommended to apply them AFTER you bring the other stlying inline.
		Note: test carefully with Yahoo.
		Note 2: Don't bring anything below this line inline.
		****************************************************
		***************************************************/

		/* NOTE: To properly use @media queries and play nice with yahoo mail, use attribute selectors in place of class, id declarations.
		table[class=classname]
		Read more: http://www.campaignmonitor.com/blog/post/3457/media-query-issues-in-yahoo-mail-mobile-email/
		*/
		@media only screen and (max-device-width: 480px) {

			/* A nice and clean way to target phone numbers you want clickable and avoid a mobile phone from linking other numbers that look like, but are not phone numbers.  Use these two blocks of code to "unstyle" any numbers that may be linked.  The second block gives you a class to apply with a span tag to the numbers you would like linked and styled.
			Inspired by Campaign Monitor's article on using phone numbers in email: http://www.campaignmonitor.com/blog/post/3571/using-phone-numbers-in-html-email/.
			Step 1 (Step 2: line 224)
			*/
			a[href^="tel"], a[href^="sms"] {
						text-decoration: none;
						color: black; /* or whatever your want */
						pointer-events: none;
						cursor: default;
					}

			.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
						text-decoration: default;
						color: orange !important; /* or whatever your want */
						pointer-events: auto;
						cursor: default;
					}
		}

		/* More Specific Targeting */

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
			/* You guessed it, ipad (tablets, smaller screens, etc) */

			/* Step 1a: Repeating for the iPad */
			a[href^="tel"], a[href^="sms"] {
						text-decoration: none;
						color: blue; /* or whatever your want */
						pointer-events: none;
						cursor: default;
					}

			.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
						text-decoration: default;
						color: orange !important;
						pointer-events: auto;
						cursor: default;
					}
		}

		@media only screen and (-webkit-min-device-pixel-ratio: 2) {
			/* Put your iPhone 4g styles in here */
		}

		/* Following Android targeting from:
		http://developer.android.com/guide/webapps/targeting.html
		http://pugetworks.com/2011/04/css-media-queries-for-targeting-different-mobile-devices/  */
		@media only screen and (-webkit-device-pixel-ratio:.75){
			/* Put CSS for low density (ldpi) Android layouts in here */
		}
		@media only screen and (-webkit-device-pixel-ratio:1){
			/* Put CSS for medium density (mdpi) Android layouts in here */
		}
		@media only screen and (-webkit-device-pixel-ratio:1.5){
			/* Put CSS for high density (hdpi) Android layouts in here */
		}
		/* end Android targeting */
	</style>

	<!-- Targeting Windows Mobile -->
	<!--[if IEMobile 7]>
	<style type="text/css">
	</style>
	<![endif]-->

	<!-- ***********************************************
	****************************************************
	END MOBILE TARGETING
	****************************************************
	************************************************ -->

	<!--[if gte mso 9]>
	<style>
		/* Target Outlook 2007 and 2010 */
	</style>
	<![endif]-->
</head>
<body>
	<!-- Wrapper/Container Table: Use a wrapper table to control the width and the background color consistently of your email. Use this approach instead of setting attributes on the body tag. -->
	<table cellpadding="0" cellspacing="0" border="0" id="backgroundTable" bgcolor="#f0f0f0">
	<tr>
		<td>

		<!-- Tables are the most common way to format your email consistently. Set your table widths inside cells and in most cases reset cellpadding, cellspacing, and border to zero. Use nested tables as a way to space effectively in your message. -->
		<table width="700" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#fff">
			<tr>
				<td colspan="3" width="700" height="25">
					&nbsp;
				</td>
			</tr>
			<tr>
				<td  width="30" height="68">
					&nbsp;
				</td>
				<td width="376" height="68" valign="top">
					<img class="image_fix" src="https://entecki.com.br/mail/entecki.jpg" alt="Entecki - Inteligência em gerenciamento, planejamento e gestão de obrast" title="Entecki - Inteligência em gerenciamento, planejamento e gestão de obras" width="376" height="68" />
				</td>
				<td width="324" height="68" valign="top">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" width="700" height="25">
					&nbsp;
				</td>
			</tr>
			<tr>
				<td colspan="3" width="700" height="20" bgcolor="#002953">
					&nbsp;
				</td>
			</tr>
			<tr>
				<td colspan="3" width="700" height="20">
					<table width="700" cellpadding="0" cellspacing="0" border="0" align="center">
						<tr>
							<td  width="30">
								&nbsp;
							</td>
							<td width="640" style="font-size: 14px; font-family: Arial; padding: 15px 0; line-height: 20px;">
								Prezado(s),<br>
								Segue relatório do empreendimento abaixo:
							</td>
							<td  width="30">
								&nbsp;
							</td>
						</tr>
						<tr>
							<td  width="30">
								&nbsp;
							</td>
							<td width="640">
								<table width="640" cellpadding="0" cellspacing="0" border="0" align="center">
									<tr>
										<td width="158" height="184">
											<img class="image_fix" src="https://entecki.com.br/mail/obra.jpg" alt="BROOKLIN SKYMARK" title="BROOKLIN SKYMARK" width="158" height="184" />
										</td>

										<td width="10">
											&nbsp;
										</td>
										<td width="472"  valign="top">
											<table width="472"  height="184" cellpadding="0" cellspacing="0" border="0" align="center" style="border-bottom: 1px solid #ae9c20; padding-bottom: 10px;">
												<tr>
													<td colspan="2" bgcolor="#ae9c20" style="
														padding: 5px 5px 0;
													    font-size: 20px;
													    font-family: Arial;
													    color: #fff;
													    font-weight: bold;
													    line-height: 26px;
													">
														{{ $obra }}
													</td>
												</tr>
												<tr>
													<td colspan="2" bgcolor="#ae9c20"  style="

														padding: 0 5px 5px;
													    font-size: 16px;
													    font-family: Arial;
													    color: #fff;
													    font-weight: normal;
													    line-height: 20px;
													    ">
														<strong>CONSTRUTORA:</strong> {{ $construtora }}
													</td>
												</tr>
												<tr>
													<td valign="top" style="padding-left: 5px; font-family: Arial; font-size: 12px; line-height: 20px; padding-top: 10px; padding-bottom: 10px;">
														<strong>LOCAL/REGIÃO:</strong> {{ $localregiao }}<br>
														<strong>CIDADE/ESTADO:</strong> {{ $cidadeestado }}<br>
														<strong>RAZÃO SOCIAL:</strong> {{ $razaosocial }}<br>
														<strong>CNPJ DA SPE:</strong> {{ $cnpj }}<br>
														<strong>ENDEREÇO:</strong> {{ $endereco }}
													</td>
													<td valign="top" style=" font-family: Arial; font-size: 12px; line-height: 20px; padding-top: 10px; padding-bottom: 10px;">
														<strong>REGIME CONTRATO:</strong> {{ $regimecontrato }}<br>
														<strong>REGIME RELATÓRIO:</strong> {{ $regimerelatorio }}<br>
														<strong>DATA EMISSÃO:</strong> {{ $dataemissao }}<br>
														<strong>OBRA Nº:</strong> {{ $obran }}
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
							<td  width="30">
								&nbsp;
							</td>
						</tr>


						<tr>

							<td colspan="3" height="30"  width="700">
								&nbsp;
							</td>
						</tr>


						<tr>
							<td  width="30">
								&nbsp;
							</td>
							<td width="640">
								<table width="640" cellpadding="0" cellspacing="0" border="0" align="center">
									<tr>
										<td style="font-size: 16px; font-weight: bold; font-family: Arial; color: #ae9c20; text-align: center;">
											<strong style="color: #484742;">
												MÊS REFERÊNCIA:
											</strong>
											 {{ $mesreferencia }}
										</td>
										<td style="font-size: 16px; font-weight: bold; font-family: Arial; color: #ae9c20; text-align: center;">
											<strong style="color: #484742;">
												STATUS DA OBRA:
											</strong>
											 {{ $status }}
										</td>
									</tr>
								</table>
							</td>
							<td  width="30">
								&nbsp;
							</td>
						</tr>

						<tr>

							<td colspan="3" height="20"  width="700">
								&nbsp;
							</td>
						</tr>
						<tr>
							<td  width="30">
								&nbsp;
							</td>
							<td width="640">
								<table width="640" cellpadding="0" cellspacing="0" border="0" align="center">
									<tr>
										<td bgcolor="#ae9c20" style="font-size: 14px;  font-weight: bold; font-family: Arial; color: #fff; text-align: left; padding: 5px;">
											INDICADORES OBRA
										</td>
										<td bgcolor="#ae9c20" style="font-size: 14px; font-weight: bold; font-family: Arial; color: #fff; text-align: right; padding: 5px;">
											ACUM. CONTR.: {{ $acumcontr }}
										</td>
									</tr>
								</table>
							</td>
							<td  width="30">
								&nbsp;
							</td>
						</tr>
						<tr>
							<td  width="30">
								&nbsp;
							</td>
							<td width="640">
								<table width="640" cellpadding="0" cellspacing="0" border="0" align="center" style="border-bottom: 1px solid #002953">
									<tr>
										<td bgcolor="#002953" style="font-size: 12px;  font-weight: bold; font-family: Arial; color: #fff; text-align: center; padding: 5px;">
											Custo P.
										</td>
										<td bgcolor="#002953" style="font-size: 12px; font-weight: bold; font-family: Arial; color: #fff; text-align: center; padding: 5px;">
											Prazo
										</td>
										<td bgcolor="#002953" style="font-size: 12px;  font-weight: bold; font-family: Arial; color: #fff; text-align: center; padding: 5px;">
											Fluxo D.
										</td>
										<td bgcolor="#002953" style="font-size: 12px; font-weight: bold; font-family: Arial; color: #fff; text-align: center; padding: 5px;">
											Qualidade
										</td>
										<td bgcolor="#002953" style="font-size: 12px;  font-weight: bold; font-family: Arial; color: #fff; text-align: center; padding: 5px;">
											Seg./Org.
										</td>
										<td bgcolor="#002953" style="font-size: 12px; font-weight: bold; font-family: Arial; color: #fff; text-align: center; padding: 5px;">
											M. Ambi.
										</td>
									</tr>

									<tr>
										<td style="text-align: center; padding: 5px;">
											<img class="image_fix" src="https://entecki.com.br/mail/{{ $CUSTOP['FAROL'] }}.png" alt="{{ $CUSTOP['ALT'] }}" title="{{ $CUSTOP['TITLE'] }}" width="15" height="15" style="margin-left: 45px;" />
										</td>
										<td style="text-align: center; padding: 5px;">
											<img class="image_fix" src="https://entecki.com.br/mail/{{ $PRAZO['FAROL'] }}.png" alt="{{ $PRAZO['ALT'] }}" title="{{ $PRAZO['TITLE'] }}" width="15" height="15" style="margin-left: 45px;" />
										</td>
										<td style="text-align: center; padding: 5px;">
											<img class="image_fix" src="https://entecki.com.br/mail/{{ $FLUXOD['FAROL'] }}.png" alt="{{ $FLUXOD['ALT'] }}" title="{{ $FLUXOD['TITLE'] }}" width="15" height="15" style="margin-left: 45px;" />
										</td>
										<td style="text-align: center; padding: 5px;">
											<img class="image_fix" src="https://entecki.com.br/mail/{{ $QUALIDADE['FAROL'] }}.png" alt="{{ $QUALIDADE['ALT'] }}" title="{{ $QUALIDADE['TITLE'] }}" width="15" height="15" style="margin-left: 45px;" />
										</td>
										<td style="text-align: center; padding: 5px;">
											<img class="image_fix" src="https://entecki.com.br/mail/{{ $SEGORG['FAROL'] }}.png" alt="{{ $SEGORG['ALT'] }}" title="{{ $SEGORG['TITLE'] }}" width="15" height="15" style="margin-left: 45px;" />
										</td>
										<td style="text-align: center; padding: 5px;">
											<img class="image_fix" src="https://entecki.com.br/mail/{{ $MAMBI['FAROL'] }}.png" alt="{{ $MAMBI['ALT'] }}" title="{{ $MAMBI['TITLE'] }}" width="15" height="15" style="margin-left: 45px;" />
										</td>
									</tr>
								</table>
							</td>
							<td  width="30">
								&nbsp;
							</td>
						</tr>

						<tr>
							<td  width="30">
								&nbsp;
							</td>
							<td width="640" style="font-size: 14px; font-family: Arial; padding: 15px 0; line-height: 20px;">
								Para mais informações, consulte nosso site, em sua área do cliente:
							</td>
							<td  width="30">
								&nbsp;
							</td>
						</tr>
						<tr>
							<td  width="30">
								&nbsp;
							</td>
							<td width="640" style="text-align: center;">
								<a href="http://www.entecki.com.br/areadocliente" target="_blank"  style="font-size: 18px; line-height: 60px; background: #ae9c20;  color: #fff; font-family: Arial; padding:0 30px; display: inline-block;">
									www.entecki.com.br/areadocliente
								</a>
							</td>
							<td  width="30">
								&nbsp;
							</td>
						</tr>
						<tr>

							<td colspan="3" height="20"  width="700">
								&nbsp;
							</td>
						</tr>
						<tr>

							<td colspan="3" height="20"  width="700">

								<table width="700" cellpadding="0" cellspacing="0" border="0" align="center">
									<tr>
										<td bgcolor="#002953" style="font-size: 14px;  font-weight: bold; font-family: Arial; color: #fff; text-align: center; padding: 15px 5px 0;">
											R. Borges de Figueiredo, 303 CJ 404 São Paulo - SP | CEP 03110-010
										</td>
									</tr>
									<tr>
										<td bgcolor="#002953" style="font-size: 14px; font-weight: normal; font-family: Arial; color: #fff; text-align: center; padding: 5px 5px 15px;">
											entecki@entecki.com.br | + 55 11 2157-1889
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<!-- End example table -->


		</td>
	</tr>
	</table>
	<!-- End of wrapper table -->
</body>
</html>
