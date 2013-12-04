<StyledLayerDescriptor xmlns="http://www.opengis.net/sld" xmlns:ogc="http://www.opengis.net/ogc" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" version="1.0.0" xsi:schemaLocation="http://www.opengis.net/sld StyledLayerDescriptor.xsd">
<NamedLayer>
<Name>Poi-kohteet</Name>
<UserStyle>
<FeatureTypeStyle>

<!--
pysakointi=1
este=2
porras=3
vesipiste=4
wc=5
-->
<Rule>
<Name>Pysakointi</Name>
<ogc:Filter>
<ogc:PropertyIsEqualTo>
<ogc:PropertyName>
type
</ogc:PropertyName>
<ogc:Literal>
1
</ogc:Literal>
<ogc:PropertyIsEqualTo>
</ogc:Filter>
 <PointSymbolizer>
   <Graphic>
     <ExternalGraphic>
       <OnlineResource xlink:type="simple" xlink:href="pysakointi.svg" />
       <Format>image/svg+xml</Format>
     </ExternalGraphic>
     <Size>20</Size>
   </Graphic>
 </PointSymbolizer>
</Rule>

<Rule>
<Name>Este</Name>
<ogc:Filter>
<ogc:PropertyIsEqualTo>
<ogc:PropertyName>type</ogc:PropertyName>
<ogc:Literal>2</ogc:Literal>
<ogc:PropertyIsEqualTo>
</ogc:Filter>
 <PointSymbolizer>
   <Graphic>
     <ExternalGraphic>
       <OnlineResource xlink:type="simple" xlink:href="este.svg" />
       <Format>image/svg+xml</Format>
     </ExternalGraphic>
     <Size>20</Size>
   </Graphic>
 </PointSymbolizer>
</Rule>

<Rule>
<Name>Portaat</Name>
<ogc:Filter>
<ogc:PropertyIsEqualTo>
<ogc:PropertyName>type</ogc:PropertyName>
<ogc:Literal>3</ogc:Literal>
<ogc:PropertyIsEqualTo>
</ogc:Filter>
 <PointSymbolizer>
   <Graphic>
     <ExternalGraphic>
       <OnlineResource xlink:type="simple" xlink:href="porras.svg" />
       <Format>image/svg+xml</Format>
     </ExternalGraphic>
     <Size>20</Size>
   </Graphic>
 </PointSymbolizer>
</Rule>

<Rule>
<Name>Vesi</Name>
<ogc:Filter>
<ogc:PropertyIsEqualTo>
<ogc:PropertyName>type</ogc:PropertyName>
<ogc:Literal>4</ogc:Literal>
<ogc:PropertyIsEqualTo>
</ogc:Filter>
 <PointSymbolizer>
   <Graphic>
     <ExternalGraphic>
       <OnlineResource xlink:type="simple" xlink:href="vesi.svg" />
       <Format>image/svg+xml</Format>
     </ExternalGraphic>
     <Size>20</Size>
   </Graphic>
 </PointSymbolizer>
</Rule>

<Rule>
<Name>WC</Name>
<ogc:Filter>
<ogc:PropertyIsEqualTo>
<ogc:PropertyName>type</ogc:PropertyName>
<ogc:Literal>5</ogc:Literal>
<ogc:PropertyIsEqualTo>
</ogc:Filter>
 <PointSymbolizer>
   <Graphic>
     <ExternalGraphic>
       <OnlineResource xlink:type="simple" xlink:href="wc.svg" />
       <Format>image/svg+xml</Format>
     </ExternalGraphic>
     <Size>20</Size>
   </Graphic>
 </PointSymbolizer>
</Rule>

<Rule>
<Name>Labelit_kaikille</Name>
<MaxScaleDenominator>20000</MaxScaleDenominator>
 <TextSymbolizer>
         <Label>
           <ogc:PropertyName>selite</ogc:PropertyName>
         </Label>
         <Fill>
           <CssParameter name="fill">#000000</CssParameter>
         </Fill>
 </TextSymbolizer>
</Rule>
  
</FeatureTypeStyle>
</UserStyle>
</NamedLayer>
</StyledLayerDescriptor>
