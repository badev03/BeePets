
import React from 'react';


const StatisticalPet = () => {
    return (
        <div id="contenitore">
  <div className="left">
    <table>
      <caption>Date table</caption>
      <tbody>
        <tr><td>CHÓ</td><td>80%</td><td style={{backgroundColor: '#336699'}}>&nbsp;</td></tr>
        <tr><td>MÈO</td><td>68%</td><td style={{backgroundColor: '#003366'}}>&nbsp;</td></tr>
        <tr><td>CHIM</td><td>30%</td><td style={{backgroundColor: '#ff6600'}}>&nbsp;</td></tr>
        <tr><td>CHUỘT</td><td>20%</td><td style={{backgroundColor: '#ffcc00'}}>&nbsp;</td></tr>
      </tbody></table>
    <div className="button" onClick="viewGraph()">Rerun</div>
  </div>
  <div className="left">
    <div id="grafico">
      <div className="riga" style={{top: '25%'}}><div>75%</div></div>
      <div className="riga" style={{top: '50%'}}><div>50%</div></div>
      <div className="riga" style={{top: '75%'}}><div>25%</div></div>
      <div id="col0" style={{left: 0, backgroundColor: '#336699'}} className="column" />
      <div id="col1" style={{left: '25%', backgroundColor: '#003366'}} className="column" />
      <div id="col2" style={{left: '50%', backgroundColor: '#ff6600'}} className="column" />
      <div id="col3" style={{left: '75%', backgroundColor: '#ffcc00'}} className="column" />
    </div>
  </div>
  <div className="canc" />
</div>

    );
};

export default StatisticalPet;