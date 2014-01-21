<StyledLayerDescriptor xmlns="http://www.opengis.net/sld" xmlns:ogc="http://www.opengis.net/ogc" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="1.0.0" xsi:schemaLocation="http://www.opengis.net/sld StyledLayerDescriptor.xsd">
<NamedLayer>
<Name>trail</Name>
<UserStyle>
<Title>Trail-segment</Title>
<FeatureTypeStyle>
  <!-- luokiteltujen polkujen kuvaaamiseen-->
  <Rule>
  <LineSymbolizer>
  <Stroke><!-- Musta viiva taustalle-->
    <CssParameter name="stroke"><ogc:Function name="Recode">
      <!-- Value to transform -->
      <ogc:PropertyName>selkeys</ogc:PropertyName>
    
      <!-- Map of input to output values -->
      <ogc:Literal>1</ogc:Literal>
      <ogc:Literal>#808080</ogc:Literal>
    
      <ogc:Literal>2</ogc:Literal>
      <ogc:Literal>#333333</ogc:Literal>
    
      <ogc:Literal>3</ogc:Literal>
      <ogc:Literal>#000000</ogc:Literal>
      </ogc:Function>
    </CssParameter>
    <CssParameter name="stroke-width">
    <ogc:Add>
    <ogc:PropertyName>epatas</ogc:PropertyName>
    <ogc:Literal>2</ogc:Literal>
    </ogc:Add>
    </CssParameter>
    <CssParameter name="stroke-linecap">round</CssParameter>
  </Stroke>
  </LineSymbolizer>
  </Rule>
  <Rule><!-- varitetty viiva katkona pintaan-->
  <LineSymbolizer>
  <Stroke>
    <CssParameter name="stroke">
      <ogc:Function name="Recode">
      <!-- Value to transform -->
      <ogc:PropertyName>alusta</ogc:PropertyName>
    
      <!-- Map of input to output values -->
      <ogc:Literal>4</ogc:Literal>
      <ogc:Literal>#3399FF</ogc:Literal>
    
      <ogc:Literal>2</ogc:Literal>
      <ogc:Literal>#B0C4DE</ogc:Literal>
    
      <ogc:Literal>1</ogc:Literal>
      <ogc:Literal>#009900</ogc:Literal>
    
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
    <ogc:PropertyName>epatas</ogc:PropertyName>
    </CssParameter>
    <CssParameter name="stroke-linecap">round</CssParameter>
        <CssParameter name="stroke-dasharray">5 5</CssParameter>    
  </Stroke>
  </LineSymbolizer>
  </Rule>
</FeatureTypeStyle>
</UserStyle>
</NamedLayer>
</StyledLayerDescriptor>
