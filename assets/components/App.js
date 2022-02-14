import React from "react";
import CalculationForm from "./CalculationForm";

class App extends React.Component {

    render() {
        return (
            <div>
                <h1>Mini calculatrice</h1>
                <CalculationForm />
            </div>
        )
    }
}

export default App;