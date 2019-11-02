import React from "react";
import { IntlProvider } from "react-intl";
import Cominovel from "./Cominovel";
import { ICominovelProps } from "./interfaces/CominovelProps";

declare global {
  // tslint:disable-next-line: interface-name
  interface Window {
    Cominovel: ICominovelProps;
  }
}

const App: React.FC = () => {
  return (
    <IntlProvider locale="en">
      <Cominovel />
    </IntlProvider>
  );
};

export default App;
