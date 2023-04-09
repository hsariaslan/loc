import React, {useEffect, useState} from 'react';
import { useDispatch, useSelector } from 'react-redux';
import {
    decrement,
    increment,
    incrementByAmount,
    selectFixtures,
    setFixtures,
    updateTeams,
    generateFixtures,
    // getTeams
} from "../reducers/exampleReducer";
import { FixturesService } from "../services";
import {Link} from "react-router-dom";

const GenerateFixtures = () => {
    const dispatch = useDispatch();
    const fixtures = useSelector(selectFixtures);

    useEffect(() => {
        FixturesService.generateFixtures().then(data => {
            dispatch(setFixtures(data));
        });
    }, [fixtures.whenToUpdateProp]);

    console.log(fixtures);
    let weekCount = -1;
    let i = -1;

    const fixturesList = fixtures.map((week) => {
        weekCount ++;

        return (
            <li key={weekCount} className="list-group-item text-start">
                <h4>Week {weekCount + 1}</h4>
                {week.map((teams) => {
                    i ++;
                    return (
                        <div key={i}>
                            {teams[0] + " - " + teams[1]}
                        </div>
                    )
                })}
            </li>
        );
    });

    return (
        <div className="container mt-5">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card text-center">
                        <div className="card-header"><h2>Generated Fixtures</h2></div>
                        <div className="card-body">
                            <ul className="list-group">
                                {fixturesList}
                            </ul>
                            <Link to="/" className="btn btn-danger mt-3">Back</Link>
                            <Link to="/simulation" className="btn btn-primary mt-3 mx-3">Start Simulation</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default GenerateFixtures;
