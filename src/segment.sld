<StyledLayerDescriptor xmlns="http://www.opengis.net/sld" xmlns:ogc="http://www.opengis.net/ogc" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="1.0.0" xsi:schemaLocation="http://www.opengis.net/sld StyledLayerDescriptor.xsd">
<NamedLayer>
<Name>trail</Name>
<UserStyle>
<Title>Trail-segment</Title>
<FeatureTypeStyle>
  <!-- luokiteltujen polkujen kuvaaamiseen-->
  <Rule>
  <ogc:Filter><ogc:PropertyIsEqualTo>
  <ogc:PropertyName>selkeys</ogc:PropertyName>
  <ogc:Literal>3</ogc:Literal>
  </ogc:PropertyIsEqualTo></ogc:Filter>
  <LineSymbolizer>
  <Stroke><!-- Musta viiva taustalle-->
    <CssParameter name="stroke">#000000</CssParameter>
    <CssParameter name="stroke-width">
 <!--   <ogc:Mul>
    <ogc:PropertyName>epatas</ogc:PropertyName>
    <ogc:Literal>2.5</ogc:Literal>
    </ogc:Mul>-->
		 <ogc:Function name="Recode">
      <ogc:PropertyName>alusta</ogc:PropertyName>
      <ogc:Literal>3</ogc:Literal>
      <ogc:Literal>8</ogc:Literal>
	  
      <ogc:Literal>2</ogc:Literal>
		<ogc:Literal>7</ogc:Literal>
				  
	        <ogc:Literal>1</ogc:Literal>
      <ogc:Literal>6</ogc:Literal>
	  </ogc:Function>
    </CssParameter>
 <!--   <CssParameter name="stroke-linecap">round</CssParameter>-->
  </Stroke>
  </LineSymbolizer>
  <LineSymbolizer>
  <Stroke>
    <CssParameter name="stroke">
      <ogc:Function name="Recode">
      <ogc:PropertyName>alusta</ogc:PropertyName>
      <ogc:Literal>4</ogc:Literal>
      <ogc:Literal>#3399FF</ogc:Literal>
    
      <ogc:Literal>2</ogc:Literal>
      <ogc:Literal>#E0A366</ogc:Literal>
    
      <ogc:Literal>1</ogc:Literal>
      <ogc:Literal>#00DD00</ogc:Literal>
    
      <ogc:Literal>3</ogc:Literal>
      <ogc:Literal>#FFCC00</ogc:Literal>
  <!--  
      <ogc:Literal>kivikko</ogc:Literal>
      <ogc:Literal>#68501F</ogc:Literal>
    
      <ogc:Literal>Muu</ogc:Literal>
      <ogc:Literal>#FFF8DC</ogc:Literal>
-->
      </ogc:Function>
    </CssParameter>
    <CssParameter name="stroke-width">
	 <ogc:Function name="Recode">
      <ogc:PropertyName>alusta</ogc:PropertyName>
      <ogc:Literal>3</ogc:Literal>
      <ogc:Literal>4</ogc:Literal>
	  
      <ogc:Literal>2</ogc:Literal>
		<ogc:Literal>3</ogc:Literal>
				  
	        <ogc:Literal>1</ogc:Literal>
      <ogc:Literal>2</ogc:Literal>
	  </ogc:Function>
    </CssParameter>
  <!--  <CssParameter name="stroke-linecap">round</CssParameter>--> 
  </Stroke>
  </LineSymbolizer>
  </Rule>
  <Rule>
  <ogc:Filter><ogc:PropertyIsEqualTo>
  <ogc:PropertyName>selkeys</ogc:PropertyName>
  <ogc:Literal>2</ogc:Literal>
  </ogc:PropertyIsEqualTo></ogc:Filter>
  <LineSymbolizer>
  <Stroke><!-- Musta viiva taustalle-->
    <CssParameter name="stroke">#000000</CssParameter>
    <CssParameter name="stroke-width">
   <!-- <ogc:Mul>
    <ogc:PropertyName>epatas</ogc:PropertyName>
    <ogc:Literal>2.5</ogc:Literal>
    </ogc:Mul>-->
		 <ogc:Function name="Recode">
      <ogc:PropertyName>alusta</ogc:PropertyName>
      <ogc:Literal>3</ogc:Literal>
      <ogc:Literal>8</ogc:Literal>
	  
      <ogc:Literal>2</ogc:Literal>
		<ogc:Literal>7</ogc:Literal>
				  
	        <ogc:Literal>1</ogc:Literal>
      <ogc:Literal>6</ogc:Literal>
	  </ogc:Function>
    </CssParameter>
 <!--   <CssParameter name="stroke-linecap">round</CssParameter> -->
	<CssParameter name="stroke-dasharray">10 5</CssParameter>  
  </Stroke>
  </LineSymbolizer>
  <LineSymbolizer>
  <Stroke>
    <CssParameter name="stroke">
      <ogc:Function name="Recode">
      <ogc:PropertyName>alusta</ogc:PropertyName>
      <ogc:Literal>4</ogc:Literal>
      <ogc:Literal>#3399FF</ogc:Literal>
    
      <ogc:Literal>2</ogc:Literal>
      <ogc:Literal>#E0A366</ogc:Literal>
    
      <ogc:Literal>1</ogc:Literal>
      <ogc:Literal>#00DD00</ogc:Literal>
    
      <ogc:Literal>3</ogc:Literal>
      <ogc:Literal>#FFCC00</ogc:Literal>
  <!--  
      <ogc:Literal>kivikko</ogc:Literal>
      <ogc:Literal>#68501F</ogc:Literal>
    
      <ogc:Literal>Muu</ogc:Literal>
      <ogc:Literal>#FFF8DC</ogc:Literal>
-->
      </ogc:Function>
    </CssParameter>
    <CssParameter name="stroke-width">
	 <ogc:Function name="Recode">
      <ogc:PropertyName>alusta</ogc:PropertyName>
      <ogc:Literal>3</ogc:Literal>
      <ogc:Literal>4</ogc:Literal>
	  
      <ogc:Literal>2</ogc:Literal>
		<ogc:Literal>3</ogc:Literal>
				  
	        <ogc:Literal>1</ogc:Literal>
      <ogc:Literal>2</ogc:Literal>
	  </ogc:Function>
    </CssParameter>
  <!--  <CssParameter name="stroke-linecap">round</CssParameter>-->
  <!--      <CssParameter name="stroke-dasharray">5 5</CssParameter>  -->  
  </Stroke>
  </LineSymbolizer>
  </Rule>
<Rule>
  <ogc:Filter><ogc:PropertyIsEqualTo>
  <ogc:PropertyName>selkeys</ogc:PropertyName>
  <ogc:Literal>1</ogc:Literal>
  </ogc:PropertyIsEqualTo></ogc:Filter>
  <LineSymbolizer>
  <Stroke><!-- Musta viiva taustalle-->
    <CssParameter name="stroke">#000000</CssParameter>
    <CssParameter name="stroke-width">
   <!-- <ogc:Mul>
    <ogc:PropertyName>epatas</ogc:PropertyName>
    <ogc:Literal>2.5</ogc:Literal>
    </ogc:Mul>-->
	 <ogc:Function name="Recode">
      <ogc:PropertyName>alusta</ogc:PropertyName>
      <ogc:Literal>3</ogc:Literal>
      <ogc:Literal>8</ogc:Literal>
	  
      <ogc:Literal>2</ogc:Literal>
		<ogc:Literal>7</ogc:Literal>
				  
	        <ogc:Literal>1</ogc:Literal>
      <ogc:Literal>6</ogc:Literal>
	  </ogc:Function>
    </CssParameter>
<!--    <CssParameter name="stroke-linecap">round</CssParameter>-->
	<CssParameter name="stroke-dasharray">10 10</CssParameter>  
  </Stroke>
  </LineSymbolizer>
  <LineSymbolizer>
  <Stroke>
    <CssParameter name="stroke">
      <ogc:Function name="Recode">
      <ogc:PropertyName>alusta</ogc:PropertyName>
      <ogc:Literal>4</ogc:Literal>
      <ogc:Literal>#3399FF</ogc:Literal>
    
      <ogc:Literal>2</ogc:Literal>
      <ogc:Literal>#E0A366</ogc:Literal>
    
      <ogc:Literal>1</ogc:Literal>
      <ogc:Literal>#00DD00</ogc:Literal>
    
      <ogc:Literal>3</ogc:Literal>
      <ogc:Literal>#FFCC00</ogc:Literal>
  <!--  
      <ogc:Literal>kivikko</ogc:Literal>
      <ogc:Literal>#68501F</ogc:Literal>
    
      <ogc:Literal>Muu</ogc:Literal>
      <ogc:Literal>#FFF8DC</ogc:Literal>
-->
      </ogc:Function>
    </CssParameter>
    <CssParameter name="stroke-width">
	 <ogc:Function name="Recode">
      <ogc:PropertyName>alusta</ogc:PropertyName>
      <ogc:Literal>3</ogc:Literal>
      <ogc:Literal>4</ogc:Literal>
	  
      <ogc:Literal>2</ogc:Literal>
		<ogc:Literal>3</ogc:Literal>
				  
	        <ogc:Literal>1</ogc:Literal>
      <ogc:Literal>2</ogc:Literal>
	  </ogc:Function>
    </CssParameter>
  <!--  <CssParameter name="stroke-linecap">round</CssParameter>-->
   <!--     <CssParameter name="stroke-dasharray">10 10</CssParameter> -->   
  </Stroke>
  </LineSymbolizer>
  </Rule>  
</FeatureTypeStyle>
</UserStyle>
</NamedLayer>
</StyledLayerDescriptor>
