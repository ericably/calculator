import React, {Component} from 'react';
import axios from "axios";

export default class CalculationForm extends Component {
    constructor(props) {
        super(props);
        this.state = {
            operation: '',
            result: '',
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleChange = (event) =>{
        this.setState({operation: event.target.value})
    }

    handleSubmit = (event) => {
        event.preventDefault();
        axios.post('http://127.0.0.1:8000/calculatrice', this.state.operation).then(
            res => {
                this.setState({result: res.data.result})
            }
        );
    }

    render() {
        return (
            <div>
                <form name="calculation" method="post" onSubmit={this.handleSubmit}>
                    <input
                        id="calculation_operation"
                        name="calculation[operation]"
                        value={this.state.operation}
                        onChange={this.handleChange}
                        type="text"
                        placeholder="Entrer l'operation"
                        required="required"
                    />
                    <button>=</button>
                </form>
                <div>{this.state.result}</div>
            </div>
        )
    }
}